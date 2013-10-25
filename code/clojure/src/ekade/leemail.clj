(ns ekade.leemail
  (:require [clojure.data.xml :as xml]
            [clojure.zip :as zip]) 
  (:use [postal.core :as postal]
        [clojure.data.zip.xml :only  (attr text xml->)]
        [clojure.data.codec.base64 :as b64] 
        [ekade.helpers :as helpers]
        [clojure.java.io])
  (:gen-class))

(defn textish?
  [content-type]
  (if (or (= (subs content-type 0 4) "text")
          (= content-type "application/xml"))
    true
    false)) 

(defn prepare-attachment
  [content-type filename filepath file-content]
  (make-parents filepath)
  (let [in (b64/decode (.getBytes file-content))
        out (output-stream filepath)]
    (if (textish? content-type)
      (spit filepath (apply str (map char (byte-array in)))))
      (.write out (byte-array in)))
  {:type :inline
   :content-type content-type
   :content-id filename
   :content (java.io.File. filepath)})

(defn get-attachments
  [attachments]
  (def attfolder (format "/tmp/emajliramo/%s-%s/" (System/currentTimeMillis) (rand-int 100000)))
  (for [att attachments
        :let [zipped (zip/xml-zip att)
              content-type (first (xml-> zipped :mimeType text))
              filename (first (xml-> zipped :fileName text))
              filepath (str attfolder filename)
              file-content (first (xml-> zipped :content text))]]
    (prepare-attachment content-type filename filepath file-content)))

(defn pripremi-emajl
  [le-xml]
  (let [parsed-xml (xml/parse-str le-xml)
        zipped-xml (zip/xml-zip parsed-xml)]
    {:from (first (xml-> zipped-xml :from text))
     :to (first (xml-> zipped-xml :to text))
     :subject (first (xml-> zipped-xml :subject text))
     :bodytxt (first (xml-> zipped-xml :textBody text))
     :bodyhtml (first (xml-> zipped-xml :htmlBody text))
     :attachments (get-attachments (zip/children (first (xml-> zipped-xml :attachments))))}))

(defn emajliraj-kadu
  [xml]
  (let [emajl (pripremi-emajl xml)
        body [{:type "text/html; charset=utf-8"
               :content (:bodyhtml emajl)}]]
    (postal/send-message ^{:host (:host (:email helpers/config))
                         :user (:username (:email helpers/config))
                         :pass (:password (:email helpers/config))
                         :ssl (:ssl (:email helpers/config))}
                         {:from (:from emajl)
                          :to (:to emajl)
                          :subject (:subject emajl)
                          :body (reduce conj body (vec (:attachments emajl)))})))
