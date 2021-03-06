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
  [& args]
  (let  [conn  (rmq/connect { :host (:host (:rmq helpers/config)) :username (:username (:rmq helpers/config)) :password (:password (:rmq helpers/config)) })
         ch (lch/open conn)
         qname (:queue-name-incoming (:rmq helpers/config))]
    (println  (format " [main] Connected. Channel id: %d"  (.getChannelNumber ch) " "))
    (lq/declare ch qname :exclusive false :auto-delete false)
    (lc/subscribe ch qname lequeue/message-handler :auto-ack true)))
