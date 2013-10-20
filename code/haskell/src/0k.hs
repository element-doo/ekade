{-# LANGUAGE OverloadedStrings #-}

import Control.Applicative
import Data.Monoid
import Control.Monad.Trans
import Data.Conduit
import Data.Conduit.List
import Blaze.ByteString.Builder
import qualified Data.ByteString.Char8 as B

import Network.Wai
import Network.Wai.Handler.Warp
import Network.HTTP.Types.Status

import System.Timeout

import ZeroOpts
import PseudoMQ

main = do
  opt <- getOptions
  sr  <- sudo_sandwich (o_zmq opt)
  run (o_http opt) $ \req -> do
    body <- requestBody req $$ mconcat `fmap` consume
    lift $ print body
    rep  <- lift $ timeout (o_timeout' opt) $ mconcat `fmap` sr [body]
    lift $ print rep
    return $ maybe
      (ResponseBuilder status408 [] $ fromByteString "")
      (ResponseBuilder ok200 [("Content-Type", "application/json; charset=utf-8")] . fromByteString)
      rep

o_timeout' = floor . (* 1000000) . o_timeout
