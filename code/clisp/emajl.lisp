(require :pzmq)
(require :cffi)

(defpackage :emajl
  (:use :common-lisp :cffi))

(in-package :emajl)

(define-foreign-library libmagick
  (:unix (:or "libMagickWand.so"))
  (t (:default "libMagickWand.so")))

(use-foreign-library libmagick)
(defctype magick-wand :pointer)
(defcfun ("MagickWandGenesis" magick-wand-genesis) :void)
(defcfun ("NewMagickWand" magick-wand-new) magick-wand)
(defcfun ("MagickReadImageBlob" magick-read-image-blob) :boolean
  (img magick-wand) (buff :pointer) (len :int))
(defcfun ("MagickAdaptiveResizeImage" magic-adaptive-resize-image) :boolean
  (img magick-wand) (width :int) (height :int))
(defcfun ("MagickWriteImage" magick-write-image) :boolean
  (img magick-wand) (fname :string))
(defcfun ("MagickGetImageBlob" magick-get-image-blob) :pointer
  (img magick-wand) (len :pointer :ulong))
(defcfun ("CloneMagickWand" magick-wand-clone) magick-wand
  (img magick-wand))

(magick-wand-genesis)

(defun file-load (path)
  (with-open-file (stream path :element-type '(unsigned-byte 8))
    (let* ((len (file-length stream))
	   (buff (make-array len :element-type '(unsigned-byte 8))))
      (read-sequence buff stream)
      (values len buff))))

(defun test ()
  (multiple-value-bind (len buff) (file-load "pic.jpg")
    (with-pointer-to-vector-data (ptr buff)
      (let ((img (magick-wand-new)))
	(magick-read-image-blob img ptr len)
	(magic-adaptive-resize-image img 100 100)
	(magick-write-image img "pic2.jpg")
	(with-foreign-object (psize :int)
	  (let ((buff (magick-get-image-blob img psize)))
	    (values buff (mem-aref psize :int))))))))

(defun write-ui32 (ui32)
  (multiple-value-bind (rem a4) (truncate ui32 #x100)
    (multiple-value-bind (rem a3) (truncate rem #x100)
      (multiple-value-bind (rem a2) (truncate rem #x100)
	(multiple-value-bind (rem a1) (truncate rem #x100)
	  (declare (ignore rem))
	  (make-array 4 :element-type '(unsigned-byte 8)
		      :initial-contents (list a1 a2 a3 a4)))))))

(defun select-format (sym)
  (case sym
    (jpg  (babel:string-to-octets "jpg0_"))
    (tiff (babel:string-to-octets "tiff0"))
    (bmp  (babel:string-to-octets "bmp0_"))))

(defparameter *resize-request-size* 14)

(defun resize-request->arr (rr)
  (concatenate `(vector (unsigned-byte 8) ,*resize-request-size*)
	       (write-ui32 (first rr))
	       (write-ui32 (second rr))
	       (make-array 1 :element-type '(unsigned-byte 8)
			   :initial-contents (list (third rr)))
	       (select-format (fourth rr))))

(defun request-buffer (path &rest resize)
  (multiple-value-bind (len buff) (file-load path)
    (let ((total-len (+ 4 len 4 (* *resize-request-size* (length resize)))))
      (with-pointer-to-vector-data
	  (ptr
	   (apply #'concatenate
		  `(vector (unsigned-byte 8) ,total-len)
		  (write-ui32 len) buff
		  (write-ui32 (length resize))
		  (mapcar #'resize-request->arr resize)))
      (values total-len ptr)))))

(defun request-send (buff len &optional (server-address "tcp://localhost:5555"))
  (pzmq:with-context (ctx :max-sockets 10)
    (pzmq:with-socket (requester ctx) (:req :affinity 3 :linger 100)
      (write-line "sending ...")
      (pzmq:connect requester server-address)
      (pzmq:send requester buff :len len)
      (write-string "receiving ... ")
      (pzmq::with-message msg
	(pzmq::msg-recv msg requester)
	(print (pzmq::msg-size msg))))))

(defun test2 ()
  (multiple-value-bind (len buff)
      (request-buffer "pic.jpg"
		      '(1280 800 8 jpg)
		      '(200 100 8 jpg))
    (request-send buff len)))

 (defun read-ui32 (ptr)
   (let ((ui32 0))
     (setf (ldb (byte 8 24) ui32) (mem-aref ptr :unsigned-char 0))
     (setf (ldb (byte 8 16) ui32) (mem-aref ptr :unsigned-char 1))
     (setf (ldb (byte 8 8)  ui32) (mem-aref ptr :unsigned-char 2))
     (setf (ldb (byte 8 0)  ui32) (mem-aref ptr :unsigned-char 3))
     ui32))

(defun ptr-offset (ptr off)
  (let ((ptr* ptr))
    (incf-pointer ptr* off)
    ptr*))

(defun parse-resize (buff)
  (list (read-ui32 buff)
	(read-ui32 (ptr-offset buff 4))
	(mem-aref buff :unsigned-char 8)
	(ptr-offset buff 9)))

(defun request-parse (len buff)
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

(defun c-arr->vector (ptr len)
  (let ((vec (make-array len :element-type '(unsigned-byte 8))))
    (loop for i from 0 below len
       do (setf (aref vec i) (mem-aref ptr :unsigned-char i)))
    vec))
    
(defun image-resize (img rsz)
  (let ((new-img (magick-wand-clone img)))
	(magic-adaptive-resize-image new-img (first rsz) (second rsz))
	#+nil (print (magick-write-image new-img (concatenate 'string (symbol-name (gensym)) ".jpg")))
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
	       (request-parse (pzmq::msg-size msg) (pzmq::msg-data msg))
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
