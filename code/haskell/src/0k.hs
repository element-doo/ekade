{-# LANGUAGE OverloadedStrings #-}

--
-- A webserver translating HTTP to 0MQ and back. Run with --help for options.
--

module Main where

import Control.Applicative
import Control.Monad.Trans
import Data.Monoid

import           Blaze.ByteString.Builder       ( fromLazyByteString )
import           Blaze.ByteString.Builder.Char8 ( fromString )
import           Data.ByteString.Char8          ( ByteString )
import qualified Data.ByteString.Lazy  as B     ( fromChunks )

import qualified Data.Aeson as A      ( FromJSON(..), ToJSON(..), decode, encode )
import           Data.ProtocolBuffers ( encodeMessage, decodeMessage, Encode(..), Decode(..) )
import           Data.Serialize       ( runPut, runGetLazy )

import Data.Conduit              ( ConduitM, ($$) )
import Data.Conduit.List         ( consume )
import Network.Wai               ( Request(..), Response(..) )
import Network.Wai.Handler.Warp  ( run )
import Network.HTTP.Types.Status

import System.Timeout ( timeout )

import Types
import ZeroOpts
import PseudoMQ

main = do
  opt        <- getOptions
  send_recv  <- sudo_sandwich (o_zmq opt)

  run (o_http opt) $ \req -> do
    mdoc <- requestBody req $$ consumeJSON

    case mdoc :: Maybe Ingress of
      Nothing  -> return $ responseBadRequest "Malformed request.\n"

      Just doc -> do
        rep <- lift $ timeout (o_timeout_usec opt)
                    $ unproto `fmap` send_recv (proto doc)

        return $ case rep of
          Nothing      -> responseInternalError "Backend timeout.\n"
          Just Nothing -> responseInternalError "Backend sent crap.\n"
          Just (Just rep')
            | not $ success >< rep' -> responseInternalError $ message >< rep'
            | otherwise             -> responseOK rep'


o_timeout_usec = floor . (* 1000000) . o_timeout


proto   :: Encode a => a -> [ByteString]
unproto :: Decode a => [ByteString] -> Maybe a

proto = (:[]) . runPut . encodeMessage
unproto = either (\_ -> Nothing) Just . runGetLazy decodeMessage . B.fromChunks

consumeJSON :: (A.FromJSON a, Monad m) => ConduitM ByteString t m (Maybe a)
consumeJSON = (A.decode . B.fromChunks) `fmap` consume

responseOK            = ResponseBuilder status200 [t_json] . fromLazyByteString . A.encode
responseBadRequest    = ResponseBuilder status400 [t_json] . fromString
responseInternalError = ResponseBuilder status500 [t_json] . fromString

t_json = ("content-type", "application/json; charset=utf-8")
