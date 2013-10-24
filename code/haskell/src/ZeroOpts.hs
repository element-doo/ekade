
--
-- Because commandline options, yeah.
--

module ZeroOpts (Options(..), getOptions) where

import Control.Applicative
import Control.Monad
import Options.Applicative

data Options = Options {
    o_http    :: Int
  , o_zmq     :: String
  , o_timeout :: Float
  } deriving (Show, Eq)

getOptions :: IO Options
getOptions = execParser options

options :: ParserInfo Options
options = info (helper <*> opts) $
    fullDesc <> header   "HTTP -> 0MQ bridge"
             <> progDesc "Run a HTTP server and fulfill requests by distributing them over 0MQ."
  where
    opts = Options
      <$> readOption ( fields 10010 "http" "PORT" "HTTP port" )
      <*> strOption  ( fields "tcp://127.0.0.1:10011" "zmq" "ZMQ_ENDPOINT"
                              "ZMQ endpoint for workers to connect to" )
      <*> readOption ( fields 10 "timeout" "SEC" "How long to wait for ZMQ reply" )

fields :: Show a => a -> String -> String -> String -> Mod OptionFields a
fields val param mv desc = value val <> showDefault <> long param <> metavar mv <> help desc

readOption :: Read a => Mod OptionFields a -> Parser a
readOption m = nullOption $ reader p <> m
  where p s = case readsPrec 0 s of
          [(n, "")] -> pure n
          _         -> mzero

