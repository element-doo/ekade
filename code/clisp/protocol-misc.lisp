(defun select-format (sym)
  (case sym
    (jpg  (babel:string-to-octets "jpg0_"))
    (tiff (babel:string-to-octets "tiff0"))
    (bmp  (babel:string-to-octets "bmp0_"))))

(defparameter *resize-request-size* 14)
