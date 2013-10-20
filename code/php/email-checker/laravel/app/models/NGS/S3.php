<?php
namespace NGS;

use AmazonS3;
use InvalidArgumentException;
use LogicException;
use NGS\Converter\PrimitiveConverter;
use NGS\S3;
use NGS\Utils;
use NGS\UUID;
use S3StreamWrapper;

class S3
{
    const HOST = 's3.amazonaws.com';

    /** @var AmazonS3 singleton AmazonS3 instance */
    private static $client;

    private static $defaultBucket;

    private $bucket;
    private $key;
    private $name;
    private $length;
    private $mimeType;
    private $metadata;

    /**
     * Constructs new instance from array, stream, another NGS\S3 instance
     * @param S3|array|resource $source
     * @param string $bucket
     */
    public function __construct($source=null, $bucket=null)
    {
        if(is_array($source)) {
            self::fromArray($source);
        }
        elseif($source !== null) {
            if ($bucket !== null) {
                $this->bucket = PrimitiveConverter::toString($bucket);
            }
            if ($source instanceof S3) {
                $this->fromArray($source->toArray());
            }
            elseif (is_string($source)) {
                $this->upload($source);
            }
            elseif (is_resource($source) && get_resource_type($source)==='stream') {
                $this->upload($source);
            }
            else {
                throw new InvalidArgumentException('Cannot construct NGS\S3 from invalid type "'.Utils::getType($source).'"');
            }
        }
    }

    private function fromArray(array $values)
    {
        if (isset($values['Bucket']))
            $this->bucket   = PrimitiveConverter::toString($values['Bucket']);
        if (isset($values['Key']))
            $this->key      = PrimitiveConverter::toString($values['Key']);
        if (isset($values['Length']))
            $this->length   = PrimitiveConverter::toInteger($values['Length']);
        if (isset($values['Name']))
            $this->setName($values['Name']);
        if (isset($values['MimeType']))
            $this->setMimeType($values['MimeType']);
        if (isset($values['Metadata']))
            $this->setMetadata($values['Metadata']);
    }

    public function setName($name)
    {
        $this->name = PrimitiveConverter::toString($name);
    }

    public function setMetadata(array $metadata)
    {
        $this->metadata = PrimitiveConverter::toMap($metadata);
    }

    public function setMimeType($mimeType)
    {
        $this->mimeType = PrimitiveConverter::toString($mimeType);
    }

    public function getBucket()
    {
        return $this->bucket;
    }

    public function getKey()
    {
        return $this->key;
    }

    public function getMetadata()
    {
        return $this->metadata;
    }

    public function getMimeType()
    {
        return $this->mimeType;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getURI()
    {
        return $this->bucket+':'+$this->key;
    }

    public function __get($property)
    {
        switch ($property) {
            case 'bucket':
                return $this->getBucket();
            case 'key':
                return $this->getKey();
            case 'metaData':
                return $this->getMetadata();
            case 'mimeType':
                return $this->getMimeType();
            case 'name':
                return $this->getName();
            case 'URI':
                return $this->getURI();
            default:
                throw new InvalidArgumentException('Cannot access unexisting property "'.$property.'"');
        }
    }

    public function getUrl()
    {
        return 'http://'.self::HOST.'/'.$this->bucket.'/'.$this->key;
    }

    public function __toString()
    {
        return $this->getUrl();
    }

    public function toArray()
    {
        return array(
            'Bucket'   => $this->bucket,
            'Key'      => $this->key,
            'Length'   => $this->length,
            'Name'     => $this->name,
            'MimeType' => $this->mimeType,
            'Metadata' => $this->metadata,
        );
    }

    /**
     * Set singleton AmazonS3 instance
     * @param AmazonS3 $client
     */
    public static function setClient(AmazonS3 $client)
    {
        self::$client = $client;
    }

    /**
     * Get singleton AmazonS3 instance
     * @return AmazonS3
     */
    public static function getClient()
    {
        return self::$client;
    }

    public static function getDefaultBucket()
    {
        return self::$defaultBucket;
    }

    public static function setDefaultBucket($bucket)
    {
        if(!is_string($bucket)) {
            throw new InvalidArgumentException('Cannot set default bucket, bucket name must be a string, invalid type was '.Utils::getType($bucket));
        }
        self::$defaultBucket = $bucket;
    }

    public static function load($bucket, $key)
    {
        $response = self::loadContent($bucket, $key);
        if($response->isOK()) {
            return $response->body;
        }
        else {
            throw new InvalidArgumentException('Could not load "'.$this->bucket.'/'.$this->key.'"');
        }
    }

    public function getStream()
    {
        self::registerS3StreamWrapper();
        return fopen('s3://'.$this->bucket.'/'.$this->key, 'r');
    }

    private function _upload(array $options)
    {
        if($this->bucket === null) {
            if(self::getDefaultBucket() === null)
                throw new LogicException('Cannot upload content to S3, no bucket was provided, and no default bucket is set.');
            $this->bucket = self::getDefaultBucket();
        }
        $this->key = self::generateKey();

        if ($this->metadata !== null) {
            $options['meta'] = $this->metadata;
        }
        if ($this->mimeType !== null) {
            $options['contentType'] = $this->mimeType;
        }
        if ($this->length !== null) {
            $options['length'] = $this->length;
        }

        $response = self::getClient()->create_object($this->bucket, $this->key, $options);
        return $this->checkResponse($response, 'uploading file');
    }

    public function upload($file)
    {
        if (!is_resource($file) && !is_string($file)) {
            throw new InvalidArgumentException('Cannot upload file to S3, provided type must be stream or existing filepath, invalid type was "'.Utils::getType($file).'"');
        }
        elseif (is_resource($file) && get_resource_type($file)!=='stream') {
            throw new InvalidArgumentException('Cannot upload file to S3, provided file was stream but invalid type "'.  get_resource_type($file).'"');
        }
        elseif (is_string($file) && !is_file($file)) {
            throw new InvalidArgumentException('Cannot upload file to S3, no file found at provided path "'.$file.'"');
        }

        if(is_string($file)) {
            $file = fopen($file, 'r');
        }
        $stat = fstat($file);
        if(isset($stat['size'])) {
            $this->length = $stat['size'];
        }
        return $this->_upload(array('fileUpload' => $file));
    }

    public function uploadString($content)
    {
        if(!is_string($content)) {
            throw new InvalidArgumentException('Cannot upload string content to S3, type must be string, invalid type was "'.Utils::getType($file).'"');
        }
        $this->length = strlen($content);
        return $this->_upload(array('upload' => $content));
    }

    public function delete()
    {
        if(!isset($this->bucket)) {
            throw new \InvalidArgumentException('Cannot delete S3 object with no bucket set');
        }
        if(!isset($this->key)) {
            throw new \InvalidArgumentException('Cannot delete S3 object with no key set');
        }
        $response = self::getClient()->delete_object($this->bucket, $this->key);

        if(!$response->isOK()) {
            throw new InvalidArgumentException('Could not delete object '.$this->getURI().'');
        }
        return true;
    }

    private function checkResponse($response, $action)
    {
        if($response===null)
            throw new LogicException('Response was null');
        if($response->isOK())
            return $this;
        throw new LogicException(
            'Error while performing action ."'.$action.'. '
            .'Response status was: '.$response->status.'. '
            .'Response body: '.$response->body);
    }

    private static function registerS3StreamWrapper()
    {
        static $wrapperIsRegistered = false;
        if($wrapperIsRegistered)
            return ;
        $wrapperIsRegistered = true;
        if(!S3StreamWrapper::register(self::getClient(), 's3'))
            throw new LogicException('Failed to register S3StreamWrapper');
        return ;
    }

    private static function loadContent($bucket, $key)
    {
        return self::getClient()->get_object($bucket, $key);
    }

    private static function generateKey()
    {
        return (string)UUID::v4();
    }

};
