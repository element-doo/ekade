(ns ekade.core
  (:use [ekade.leemail :as ekemail]
        [ekade.lequeue :as lequeue]
        [ekade.helpers :as helpers]
        [clojure.java.io]) 
  (:require [langohr.core      :as rmq]
            [langohr.channel   :as lch]
            [langohr.queue     :as lq]
            [langohr.consumers :as lc]
            [langohr.basic     :as lb])
  (:gen-class))

(defn -main
  "main loop. le stuff happens here."
  [])

(defn -main
  [& args]
  (let  [conn  (rmq/connect) ch (lch/open conn) qname (:queue-name-incoming (:rmq helpers/config))]
    (println  (format " [main] Connected. Channel id: %d"  (.getChannelNumber ch) " "))
    (lq/declare ch qname :exclusive false :auto-delete true)
    (lc/subscribe ch qname lequeue/message-handler :auto-ack true)))
