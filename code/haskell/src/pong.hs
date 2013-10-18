{-# LANGUAGE OverloadedStrings  #-}

import Control.Monad

import Data.ByteString.Char8 ()
import Data.List.NonEmpty

import System.ZMQ3
import System.Environment

main = do
  addr <- getAddr
  putStrLn $ "using " ++ addr

  sock <- context >>= (`socket` Rep)
  connect sock addr

  forever $ receiveMulti sock >>= sendMulti sock . ("PONG " :|)

getAddr = do
  args <- getArgs
  return $ case args of
    addr:_ -> addr
    _      -> "tcp://127.0.0.1:10030"

