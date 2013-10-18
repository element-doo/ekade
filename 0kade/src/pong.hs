{-# LANGUAGE OverloadedStrings  #-}

import Control.Monad
import System.ZMQ3
import Data.List.NonEmpty

main = do
  mq  <- context
  skt <- socket mq Rep
  connect skt "tcp://127.0.0.1:10030"
  forever $ do
    msg <- receiveMulti skt
    sendMulti skt $ "PONG " :| msg


