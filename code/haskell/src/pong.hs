{-# LANGUAGE OverloadedStrings  #-}

import Control.Monad

import Data.ByteString.Char8 ()
import Data.List.NonEmpty

import System.ZMQ3
import System.Environment

main = do
  addr <- addrOr "tcp://127.0.0.1:10030"
  putStrLn $ "using " ++ addr

  sock <- context >>= (`socket` Rep)
  connect sock addr

  forever $ receiveMulti sock >>= sendMulti sock . ("PONG " :|)

addrOr = (`fmap` getArgs) . foldr const 
