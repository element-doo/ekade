module ZeroOpts (
    Options (..)
  , getOptions
  ) where

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
    fullDesc <> header "HTTP -> 0MQ bridge"
             <> progDesc "Run a HTTP server and fulfill requests by distributing them over 0MQ."
  where
    opts = Options
      <$> readOption
        ( value 1337 <> showDefault
          <> long "http" <> metavar "PORT" <> help "HTTP port" )
      <*> strOption
        ( value "tcp://127.0.0.1:10030" <> showDefault <> long "zmq"
          <> metavar "ZMQ_ENDPOINT" <> help "ZMQ endpoint for workers to connect to" )
      <*> readOption
        ( value 10 <> showDefault <> long "timeout"
          <> metavar "SEC" <> help "How long to wait for ZMQ reply" )

readOption :: Read a => Mod OptionFields a -> Parser a
readOption m = nullOption $ reader p <> m
  where p s = case readsPrec 0 s of
          [(n, "")] -> pure n
          _         -> mzero

