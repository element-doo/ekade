{-# LANGUAGE DeriveGeneric, FlexibleInstances, OverlappingInstances, UndecidableInstances #-}

--
-- 0k/pong message definitions. Incoming/outgoing datatype and the corresponding
-- JSON and on-the-wire protobuf representations.
--
-- Caveat: datatype definitions themself entail protobuf encoding. No .proto
-- files.
--

module Types (Ingress(..), Outgress(..), (><)) where

import GHC.Generics hiding (D1)
import Data.TypeLevel (D1, D2)

import Data.Aeson (FromJSON(..), ToJSON(..))
import Data.ProtocolBuffers
import Data.ProtocolBuffers.Internal

data Ingress
  = Ingress { email :: Required D1 (Value String)
            , kadaID  :: Optional D2 (Value String)
            } deriving (Show, Generic)

instance Encode Ingress
instance Decode Ingress
instance FromJSON Ingress

data Outgress
  = Outgress { success :: Required D1 (Value Bool)
             , message :: Required D2 (Value String)
             } deriving (Show, Generic)

instance Encode Outgress
instance Decode Outgress
instance ToJSON Outgress


instance (HasField a, FromJSON (FieldType a)) => FromJSON a where
  parseJSON = fmap putField . parseJSON

instance (HasField a, ToJSON (FieldType a)) => ToJSON a where
  toJSON = toJSON . getField

(><) :: HasField a => (b -> a) -> b -> FieldType a
(><) = (getField .) . ($)
