{-# LANGUAGE OverloadedStrings #-}

import Control.Applicative
import Data.Monoid
import Control.Monad.Trans
import Data.Conduit
import Data.Conduit.List
--  import Blaze.ByteString.Builder.Char.Utf8
import Blaze.ByteString.Builder

import Network.Wai
import Network.Wai.Handler.Warp
import Network.HTTP.Types.Status

import PseudoMQ

main = do
  sr <- sudo_sandwich "tcp://127.0.0.1:10030"
  run 1337 $ \req -> do
    body <- requestBody req $$ (mconcat <$> consume)
    rep  <- lift $ mconcat <$> sr [body]
    return $ ResponseBuilder ok200 [] $ fromByteString rep

