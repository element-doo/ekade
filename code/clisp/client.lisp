(require :pzmq)
(require :cffi)

(defpackage :emajl
  (:use :common-lisp :cffi))

(in-package :emajl)

(load "ffi.lisp")
(load "protocol-misc.lisp")

(defun file-load (path)
  (with-open-file (stream path :element-type '(unsigned-byte 8))
    (let* ((len (file-length stream))
	   (buff (make-array len :element-type '(unsigned-byte 8))))
      (read-sequence buff stream)
      (values len buff))))

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

(defun run-test ()
  (multiple-value-bind (len buff)
      (request-buffer "pic.jpg"
		      '(1280 800 8 jpg)
		      '(200 100 8 jpg))
    (request-send buff len)))
