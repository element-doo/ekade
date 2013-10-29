<?php
namespace Mailer;

require_once __DIR__.'/SendEmailJsonConverter.php';
require_once __DIR__.'/SendEmailArrayConverter.php';

/**
 * Generated from NGS DSL
 *
 * @property string $URI a unique object identifier (read-only)
 * @property string $from a string
 * @property array $to an array of strings
 * @property array $replyTo an array of strings
 * @property array $cc an array of strings
 * @property array $bcc an array of strings
 * @property string $subject a string
 * @property string $textBody a string, can be null
 * @property string $htmlBody a string, can be null
 * @property array $attachments an array of objects of class "Mailer\Attachment"
 *
 * @package Mailer
 * @version 0.9.9 beta
 */
class SendEmail extends \NGS\Patterns\DomainEvent
{
    protected $URI;
    protected $from;
    protected $to;
    protected $replyTo;
    protected $cc;
    protected $bcc;
    protected $subject;
    protected $textBody;
    protected $htmlBody;
    protected $attachments;

    /**
     * Constructs object using a key-property array or instance of class "Mailer\SendEmail"
     *
     * @param array|void $data key-property array or instance of class "Mailer\SendEmail" or pass void to provide all fields with defaults
     */
    public function __construct($data = array())
    {
        if (is_array($data)) {
            $this->fromArray($data);
        } else {
            throw new \InvalidArgumentException('Constructor parameter must be an array! Type was: '.\NGS\Utils::getType($data));
        }
    }

    /**
     * Supply default values for uninitialized properties
     *
     * @param array $data key-property array which will be filled in-place
     */
    private static function provideDefaults(array &$data)
    {
        if(!array_key_exists('URI', $data))
            $data['URI'] = null; //a string representing a unique object identifier
        if(!array_key_exists('from', $data))
            $data['from'] = ''; // a string
        if(!array_key_exists('to', $data))
            $data['to'] = array(); // an array of strings
        if(!array_key_exists('replyTo', $data))
            $data['replyTo'] = array(); // an array of strings
        if(!array_key_exists('cc', $data))
            $data['cc'] = array(); // an array of strings
        if(!array_key_exists('bcc', $data))
            $data['bcc'] = array(); // an array of strings
        if(!array_key_exists('subject', $data))
            $data['subject'] = ''; // a string
        if(!array_key_exists('attachments', $data))
            $data['attachments'] = array(); // an array of objects of class "Mailer\Attachment"
    }

    /**
     * Constructs object from a key-property array
     *
     * @param array $data key-property array
     */
    private function fromArray(array $data)
    {
        $this->provideDefaults($data);

        if(isset($data['URI']))
            $this->URI = \NGS\Converter\PrimitiveConverter::toString($data['URI']);
        unset($data['URI']);
        if (array_key_exists('from', $data))
            $this->setFrom($data['from']);
        unset($data['from']);
        if (array_key_exists('to', $data))
            $this->setTo($data['to']);
        unset($data['to']);
        if (array_key_exists('replyTo', $data))
            $this->setReplyTo($data['replyTo']);
        unset($data['replyTo']);
        if (array_key_exists('cc', $data))
            $this->setCc($data['cc']);
        unset($data['cc']);
        if (array_key_exists('bcc', $data))
            $this->setBcc($data['bcc']);
        unset($data['bcc']);
        if (array_key_exists('subject', $data))
            $this->setSubject($data['subject']);
        unset($data['subject']);
        if (array_key_exists('textBody', $data))
            $this->setTextBody($data['textBody']);
        unset($data['textBody']);
        if (array_key_exists('htmlBody', $data))
            $this->setHtmlBody($data['htmlBody']);
        unset($data['htmlBody']);
        if (array_key_exists('attachments', $data))
            $this->setAttachments($data['attachments']);
        unset($data['attachments']);

        if (count($data) !== 0 && \NGS\Utils::WarningsAsErrors())
            throw new \InvalidArgumentException('Superflous array keys found in "Mailer\SendEmail" constructor: '.implode(', ', array_keys($data)));
    }

// ============================================================================

    /**
     * Helper getter function, body for magic method $this->__get('URI')
     * URI is a string representation of the primary key.
     *
     * @return string unique resource identifier representing this object
     */
    public function getURI()
    {
        return $this->URI;
    }

    /**
     * @return a string
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @return an array of strings
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @return an array of strings
     */
    public function getReplyTo()
    {
        return $this->replyTo;
    }

    /**
     * @return an array of strings
     */
    public function getCc()
    {
        return $this->cc;
    }

    /**
     * @return an array of strings
     */
    public function getBcc()
    {
        return $this->bcc;
    }

    /**
     * @return a string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @return a string, can be null
     */
    public function getTextBody()
    {
        return $this->textBody;
    }

    /**
     * @return a string, can be null
     */
    public function getHtmlBody()
    {
        return $this->htmlBody;
    }

    /**
     * @return an array of objects of class "Mailer\Attachment"
     */
    public function getAttachments()
    {
        return $this->attachments;
    }

    /**
     * Property getter which throws Exceptions on invalid access
     *
     * @param string $name Property name
     *
     * @return mixed
     */
    public function __get($name)
    {
        if ($name === 'URI')
            return $this->getURI(); // a string representing a unique object identifier
        if ($name === 'from')
            return $this->getFrom(); // a string
        if ($name === 'to')
            return $this->getTo(); // an array of strings
        if ($name === 'replyTo')
            return $this->getReplyTo(); // an array of strings
        if ($name === 'cc')
            return $this->getCc(); // an array of strings
        if ($name === 'bcc')
            return $this->getBcc(); // an array of strings
        if ($name === 'subject')
            return $this->getSubject(); // a string
        if ($name === 'textBody')
            return $this->getTextBody(); // a string, can be null
        if ($name === 'htmlBody')
            return $this->getHtmlBody(); // a string, can be null
        if ($name === 'attachments')
            return $this->getAttachments(); // an array of objects of class "Mailer\Attachment"

        throw new \InvalidArgumentException('Property "'.$name.'" in class "Mailer\SendEmail" does not exist and could not be retrieved!');
    }

// ============================================================================

    /**
     * Property existence checker
     *
     * @param string $name Property name to check for existence
     *
     * @return bool will return true if and only if the propery exist and is not null
     */
    public function __isset($name)
    {
        if ($name === 'URI')
            return $this->URI !== null;
        if ($name === 'from')
            return true; // a string (always set)
        if ($name === 'to')
            return true; // an array of strings (always set)
        if ($name === 'replyTo')
            return true; // an array of strings (always set)
        if ($name === 'cc')
            return true; // an array of strings (always set)
        if ($name === 'bcc')
            return true; // an array of strings (always set)
        if ($name === 'subject')
            return true; // a string (always set)
        if ($name === 'textBody')
            return $this->getTextBody() !== null; // a string, can be null
        if ($name === 'htmlBody')
            return $this->getHtmlBody() !== null; // a string, can be null
        if ($name === 'attachments')
            return true; // an array of objects of class "Mailer\Attachment" (always set)

        return false;
    }

    /**
     * @param string $value a string
     *
     * @return string
     */
    public function setFrom($value)
    {
        if ($value === null)
            throw new \InvalidArgumentException('Property "from" cannot be set to null because it is non-nullable!');
        $value = \NGS\Converter\PrimitiveConverter::toString($value);
        $this->from = $value;
        return $value;
    }

    /**
     * @param array $value an array of strings
     *
     * @return array
     */
    public function setTo($value)
    {
        if ($value === null)
            throw new \InvalidArgumentException('Property "to" cannot be set to null because it is non-nullable!');
        $value = \NGS\Converter\PrimitiveConverter::toStringArray($value, false);
        $this->to = $value;
        return $value;
    }

    /**
     * @param array $value an array of strings
     *
     * @return array
     */
    public function setReplyTo($value)
    {
        if ($value === null)
            throw new \InvalidArgumentException('Property "replyTo" cannot be set to null because it is non-nullable!');
        $value = \NGS\Converter\PrimitiveConverter::toStringArray($value, false);
        $this->replyTo = $value;
        return $value;
    }

    /**
     * @param array $value an array of strings
     *
     * @return array
     */
    public function setCc($value)
    {
        if ($value === null)
            throw new \InvalidArgumentException('Property "cc" cannot be set to null because it is non-nullable!');
        $value = \NGS\Converter\PrimitiveConverter::toStringArray($value, false);
        $this->cc = $value;
        return $value;
    }

    /**
     * @param array $value an array of strings
     *
     * @return array
     */
    public function setBcc($value)
    {
        if ($value === null)
            throw new \InvalidArgumentException('Property "bcc" cannot be set to null because it is non-nullable!');
        $value = \NGS\Converter\PrimitiveConverter::toStringArray($value, false);
        $this->bcc = $value;
        return $value;
    }

    /**
     * @param string $value a string
     *
     * @return string
     */
    public function setSubject($value)
    {
        if ($value === null)
            throw new \InvalidArgumentException('Property "subject" cannot be set to null because it is non-nullable!');
        $value = \NGS\Converter\PrimitiveConverter::toString($value);
        $this->subject = $value;
        return $value;
    }

    /**
     * @param string $value a string, can be null
     *
     * @return string
     */
    public function setTextBody($value)
    {
        $value = $value !== null ? \NGS\Converter\PrimitiveConverter::toString($value) : null;
        $this->textBody = $value;
        return $value;
    }

    /**
     * @param string $value a string, can be null
     *
     * @return string
     */
    public function setHtmlBody($value)
    {
        $value = $value !== null ? \NGS\Converter\PrimitiveConverter::toString($value) : null;
        $this->htmlBody = $value;
        return $value;
    }

    /**
     * @param array $value an array of objects of class "Mailer\Attachment"
     *
     * @return array
     */
    public function setAttachments($value)
    {
        if ($value === null)
            throw new \InvalidArgumentException('Property "attachments" cannot be set to null because it is non-nullable!');
        $value = \Mailer\AttachmentArrayConverter::fromArrayList($value, false);
        $this->attachments = $value;
        return $value;
    }

    /**
     * Property setter which checks for invalid access to domain event properties and enforces proper type checks
     *
     * @param string $name Property name
     * @param mixed $value Property value
     */
    public function __set($name, $value)
    {
        if ($name === 'URI')
            throw new \LogicException('Property "URI" in "Mailer\SendEmail" cannot be set, because event URI is populated by server!');
        if ($name === 'from')
            return $this->setFrom($value); // a string
        if ($name === 'to')
            return $this->setTo($value); // an array of strings
        if ($name === 'replyTo')
            return $this->setReplyTo($value); // an array of strings
        if ($name === 'cc')
            return $this->setCc($value); // an array of strings
        if ($name === 'bcc')
            return $this->setBcc($value); // an array of strings
        if ($name === 'subject')
            return $this->setSubject($value); // a string
        if ($name === 'textBody')
            return $this->setTextBody($value); // a string, can be null
        if ($name === 'htmlBody')
            return $this->setHtmlBody($value); // a string, can be null
        if ($name === 'attachments')
            return $this->setAttachments($value); // an array of objects of class "Mailer\Attachment"
        throw new \InvalidArgumentException('Property "'.$name.'" in class "Mailer\SendEmail" does not exist and could not be set!');
    }

    /**
     * Will unset a property if it exists, but throw an exception if it is not nullable
     *
     * @param string $name Property name to unset (set to null)
     */
    public function __unset($name)
    {
        if ($name === 'URI')
            throw new \LogicException('The property "URI" cannot be unset because event URI is created by server!');
        if ($name === 'from')
            throw new \LogicException('The property "from" cannot be unset because it is non-nullable!'); // a string (cannot be unset)
        if ($name === 'to')
            throw new \LogicException('The property "to" cannot be unset because it is non-nullable!'); // an array of strings (cannot be unset)
        if ($name === 'replyTo')
            throw new \LogicException('The property "replyTo" cannot be unset because it is non-nullable!'); // an array of strings (cannot be unset)
        if ($name === 'cc')
            throw new \LogicException('The property "cc" cannot be unset because it is non-nullable!'); // an array of strings (cannot be unset)
        if ($name === 'bcc')
            throw new \LogicException('The property "bcc" cannot be unset because it is non-nullable!'); // an array of strings (cannot be unset)
        if ($name === 'subject')
            throw new \LogicException('The property "subject" cannot be unset because it is non-nullable!'); // a string (cannot be unset)
        if ($name === 'textBody')
            $this->setTextBody(null);; // a string, can be null
        if ($name === 'htmlBody')
            $this->setHtmlBody(null);; // a string, can be null
        if ($name === 'attachments')
            throw new \LogicException('The property "attachments" cannot be unset because it is non-nullable!'); // an array of objects of class "Mailer\Attachment" (cannot be unset)
    }

    public function toJson()
    {
        return \Mailer\SendEmailJsonConverter::toJson($this);
    }

    public static function fromJson($item)
    {
        return \Mailer\SendEmailJsonConverter::fromJson($item);
    }

    public function __toString()
    {
        return 'Mailer\SendEmail'.$this->toJson();
    }

    public function __clone()
    {
        return \Mailer\SendEmailArrayConverter::fromArray(\Mailer\SendEmailArrayConverter::toArray($this));
    }

    public function toArray()
    {
        return \Mailer\SendEmailArrayConverter::toArray($this);
    }
}