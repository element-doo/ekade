{-# LANGUAGE OverloadedStrings  #-}

import Control.Monad
import System.ZMQ3
import Data.List.NonEmpty
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

