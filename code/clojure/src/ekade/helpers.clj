(ns ekade.helpers
  (:use [clojure.java.io])
  (:gen-class))

(defn load-config [filename]
  (with-open [r (reader filename)]
    (read (java.io.PushbackReader. r))))

(def ^{:const true}
    default-exchange-name "") 

(def config (load-config "config.clj")) 
