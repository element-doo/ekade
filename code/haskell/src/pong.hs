{-# LANGUAGE OverloadedStrings  #-}

--
-- Test pong proggie to talk with 0k.
--

import Control.Monad

import Data.Monoid
import qualified Data.ByteString.Char8 as B
import qualified Data.ByteString.Lazy  as B (fromChunks)
import Data.List.NonEmpty hiding (head, reverse)

import Control.Concurrent
import Control.Concurrent.Chan
import Control.Concurrent.MVar

import System.ZMQ3 hiding (message)
import System.Environment

import Data.Serialize (runPut, runGetLazy)
import Data.ProtocolBuffers

import Types

def_addr = "tcp://127.0.0.1:10011"

getAddr = (`fmap` getArgs) . foldr const $ def_addr

prefork x = do
  mq <- context
  forM_ [1..100] $ \_ -> forkIO $ responder mq
  responder mq

  where
    responder mq = do
      sock <- socket mq Rep
      connect sock def_addr
      forever $ receiveMulti sock >>= x >>= sendMulti sock . fromList


report bss = do
  putStrLn $ "-> " ++ show msg
  putStrLn $ "<- " ++ show rep
  return [ runPut $ encodeMessage rep ]

  where
    msg@(Right msg') = runGetLazy decodeMessage (B.fromChunks bss)

    rep  = Outgress { success = putField True, message = putField text }

    text = mconcat [
           "[mail: ", email >< msg', "] [kada: ", show $ kada >< msg', "]"
           ]

main = prefork report

