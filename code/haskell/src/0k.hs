{-# LANGUAGE OverloadedStrings #-}

module Main where

import Control.Applicative
import Control.Monad.Trans
import Data.Monoid

import           Blaze.ByteString.Builder
import           Blaze.ByteString.Builder.Char8 ( fromString )
import qualified Data.ByteString.Char8 as B
import qualified Data.ByteString.Lazy  as B ( fromChunks )

import qualified Data.Aeson as A ( FromJSON(..), ToJSON(..), decode, encode )
import           Data.ProtocolBuffers ( encodeMessage, decodeMessage, getField, Encode(..), Decode(..) )
import           Data.Serialize ( runPut, runGetLazy )

import Data.Conduit
import Data.Conduit.List
import Network.Wai
import Network.Wai.Handler.Warp
import Network.HTTP.Types.Status

import System.Timeout

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
            | otherwise             -> responseJSON rep'


o_timeout_usec = floor . (* 1000000) . o_timeout


proto   :: Encode a => a -> [B.ByteString]
unproto :: Decode a => [B.ByteString] -> Maybe a

proto = (:[]) . runPut . encodeMessage
unproto = either (\_ -> Nothing) Just . runGetLazy decodeMessage . B.fromChunks

consumeJSON :: (A.FromJSON a, Monad m) => ConduitM B.ByteString t m (Maybe a)
responseJSON :: A.ToJSON a => a -> Response

consumeJSON = (A.decode . B.fromChunks) `fmap` consume
responseJSON = ResponseBuilder status200 [t_json] . fromLazyByteString . A.encode
  where
    t_json = ("content-type", "application/json; charset=utf-8")

responseBadRequest    = ResponseBuilder status400 [] . fromString
responseInternalError = ResponseBuilder status500 [] . fromString
