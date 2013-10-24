;; libMagick specific
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
(defcfun ("DestroyMagickWand" magick-wand-destroy) :pointer
  (img magick-wand))
(magick-wand-genesis)

;; misc binary manipulation
(defun write-ui32 (ui32)
  (multiple-value-bind (rem a4) (truncate ui32 #x100)
    (multiple-value-bind (rem a3) (truncate rem #x100)
      (multiple-value-bind (rem a2) (truncate rem #x100)
    (multiple-value-bind (rem a1) (truncate rem #x100)
      (declare (ignore rem))
      (make-array 4 :element-type '(unsigned-byte 8)
              :initial-contents (list a1 a2 a3 a4)))))))

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

(defun c-arr->vector (ptr len)
  (let ((vec (make-array len :element-type '(unsigned-byte 8))))
    (loop for i from 0 below len
       do (setf (aref vec i) (mem-aref ptr :unsigned-char i)))
    vec))
