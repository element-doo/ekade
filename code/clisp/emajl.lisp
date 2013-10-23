(require :pzmq)
(require :cffi)

(defpackage :emajl
  (:use :common-lisp :cffi))

(in-package :emajl)

(load "ffi.lisp")
(load "protocol-misc.lisp")

(defun parse-resize (buff)
  (list (read-ui32 buff)
	(read-ui32 (ptr-offset buff 4))
	(mem-aref buff :unsigned-char 8)
	(ptr-offset buff 9)))

(defun parse-request (len buff)
  (let* ((size (read-ui32 buff))
	 (img-buff (ptr-offset buff 4))
	 (img (magick-wand-new))
	 (reqnum (read-ui32 (ptr-offset img-buff size)))
	 (req-buff (ptr-offset img-buff (+ size 4))) 
	 (reqs (loop repeat reqnum
		  for buff = req-buff then
		    (ptr-offset req-buff *resize-request-size*)
		  for req = (parse-resize buff)
		  collecting req do (print req))))
    (magick-read-image-blob img img-buff size)    
    (values img reqs)))

(defun image-resize (img rsz)
  (let ((new-img (magick-wand-clone img)))
	(magic-adaptive-resize-image new-img (first rsz) (second rsz))
	#+nil (magick-write-image
	       new-img
	       (concatenate 'string (symbol-name (gensym)) ".jpg"))
	(with-foreign-object (psize :int)
	  (let ((buff (magick-get-image-blob new-img psize)))
	    (c-arr->vector buff (mem-aref psize :int))))))

(defun persist-image (img)
  (concatenate `(vector (unsigned-byte 8) ,(+ 4 (length img)))
	       (write-ui32 (length img)) img))

(defun server (&optional (listen-address "tcp://*:5555"))
  (pzmq:with-context nil ; use *default-context*
    (pzmq:with-socket responder :rep
      (pzmq:bind responder listen-address)
      (loop
        (write-string "waiting for a request ...")
	 (pzmq::with-message msg
	   (pzmq::msg-recv msg responder)
	   (multiple-value-bind (img resizes)
	       (parse-request (pzmq::msg-size msg) (pzmq::msg-data msg))
	     (let* ((imgs (mapcar (lambda (res) (image-resize img res)) resizes))
		    (imgs-len (apply #'+ (mapcar #'length imgs)))
		    (total-len (+ 4 (* 4 (length imgs)) imgs-len)))
	       (with-pointer-to-vector-data
		   (ptr
		    (apply #'concatenate
			   `(vector (unsigned-byte 8) ,total-len)
			   (write-ui32 (length imgs))
			   (mapcar #'persist-image imgs)))
		 (pzmq:send responder ptr :len total-len)))))))))

;;main
(if (> (length sb-ext:*posix-argv*) 1)
    (progn
      (print (second sb-ext:*posix-argv*))
      (server (second sb-ext:*posix-argv*)))
    (server))
