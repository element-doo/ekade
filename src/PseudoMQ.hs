{-# LANGUAGE OverloadedStrings, ViewPatterns #-}

--
-- A simple scheme to multiplex simultaneous REQ/REP cycles over a single
-- DEALER, using hand-created 0MQ envelopes and exposing a synchronous API.
--

module PseudoMQ (sudo_sandwich) where

import           Control.Applicative
import           Control.Monad

import qualified Data.ByteString.Char8 as B
import qualified Data.HashMap.Strict as M
import           Data.List.NonEmpty

import           Control.Concurrent
import           Control.Concurrent.Chan
import           Control.Concurrent.MVar
import           Data.IORef

import           System.IO
import           System.ZMQ3

type Id      = Integer
type Message = [B.ByteString]
data Manager = Manager (IORef (Id, M.HashMap Id (MVar Message)))
                       (Chan (Id, Message))

sudo_sandwich :: String -> IO (Message -> IO Message)
sudo_sandwich addr =
  context >>= (`mkManager` addr) >>= return . send_recv

send_recv ::  Manager -> Message -> IO Message
send_recv (Manager st downstream) messages = do
  back <- newEmptyMVar
  n    <- atomicModifyIORef' st $ \(n, chans) ->
    ((n + 1, M.insert n back chans), n)
  writeChan downstream (n, messages)
  takeMVar back

mkManager :: Context -> String -> IO Manager
mkManager mq addr = do

  socket <- socket mq Dealer
  bind socket addr

  down <- newChan
  forkOn 0 $ forever $
    readChan down >>= sendMulti socket . form

  st <- newIORef (0, M.empty)
  forkOn 0 $ dispatch socket st

  return $ Manager st down

dispatch :: Receiver a => Socket a -> IORef (b, M.HashMap Id (MVar Message)) -> IO ()
dispatch socket st = forever $ do
  ms <- receiveMulti socket
  case deform ms of
       Nothing        -> nope ms
       Just (id, ms') ->
         atomicModifyIORef' st (dequeue id) >>=
           maybe (nope ms) (`putMVar` ms')
  where
    dequeue id (n, chans) =
      maybe ((n, chans), Nothing)
            (\back -> ((n, M.delete id chans), Just back)) $
        M.lookup id chans

    nope = hPutStrLn stderr . ("bad 0mq msg: " ++) . show

form (id, msgs) = B.pack (show id) :| "" : msgs

deform ((B.readInteger -> Just (n, "")):"":msgs) = Just (n, msgs)
deform _ = Nothing

