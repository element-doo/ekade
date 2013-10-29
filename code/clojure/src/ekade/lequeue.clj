(ns ekade.lequeue
  (:require [langohr.core      :as rmq]
            [langohr.channel   :as lch]
            [langohr.queue     :as lq]
            [langohr.consumers :as lc]
            [langohr.basic     :as lb]) 
  (:use [ekade.leemail :as leemail]
        [ekade.helpers :as helpers]
        [clojure.data.json :as json])
  (:gen-class))

(defn message-handler
  [ch {:keys [content-type delivery-tag type] :as meta} ^bytes payload]
  (let [result (leemail/emajliraj-kadu (String. payload "UTF-8"))
        json-result (json/write-str result)]))
