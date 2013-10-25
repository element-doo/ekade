<?php
namespace NGS;

require_once(__DIR__.'/Utils.php');

use NGS\Utils;

/**
 * UUID implementation
 */
class UUID
{
    /**
     * @var string
     */
    private $value;

    /**
     * Constructs new UUID from UUID string, existing instance, or by generating
     * version 4 UUID
     * @param null|string|\NGS\UUID
     * @throws \InvalidArgumentException
     */
    public function __construct($value = null)
    {
        if (null === $value) {
            $this->value = self::_v4();
        }
        elseif (is_string($value)) {
            if (!self::isValid($value)) {
                throw new \InvalidArgumentException('UUID could not be constructed from invalid value: "'.$value.'"');
            }
            $this->value = $value;
        }
        elseif ($value instanceof \NGS\UUID) {
            $this->value = $value->value;
        }
        else {
            throw new \InvalidArgumentException('UUID could not be constructed from type "'.gettype($value).'"');
        }
    }

    /**
     * Creates array of UUIDs from array by constructing UUID instance from each element of array as __construct
     * argument.
     * arguments
     * @param array $items
     * @return array Array of UUID instances
     * @throws \InvalidArgumentException
     */
    public static function toArray(array $items, $allowNullValues=false)
    {
        $results = array();
        try {
            foreach ($items as $key => $val) {
                if ($allowNullValues && $val===null) {
                    $results[] = null;
                } elseif ($val === null) {
                    throw new \InvalidArgumentException('Null value found in provided array');
                } elseif(!$val instanceof \NGS\UUID) {
                    $results[] = new \NGS\UUID($val);
                } else {
                    $results[] = $val;
                }
            }
        }
        catch(\Exception $e) {
            throw new \InvalidArgumentException('Element at index '.$key.' could not be converted to UUID!', 42, $e);
        }
        return $results;
    }

    /**
     * Allows accessing UUID string value as property, e.g. $instance->value
     * @param string $name
     * @return string
     * @throws \InvalidArgumentException
     */
    public function __get($name)
    {
        if($name==='value') {
            return $this->value;
        }
        else {
            throw new \InvalidArgumentException('UUID: Cannot get undefined property "'.$name.'"');
        }
    }

    /**
     * Constructs new UUID instance by with generated version 3 UUID (MD5 hash)
     * @param    string|\NGS\UUID uuid $namespace
     * @param    string    $name
     * @return \NGS\UUID
     * @throws \InvalidArgumentException
     */
    public static function v3($namespace, $name)
    {
        if ($namespace instanceof \NGS\UUID) {
            $namespace = $namespace->value;
        }
        elseif (!is_string($namespace)) {
            throw new \InvalidArgumentException('Cannot create uuid v3 from invalid namespace type: "'.Utils::getType($namespace).'"');
        }
        if(!is_string($name)) {
            throw new \InvalidArgumentException('Cannot create uuid v3 from invalid name type: "'.Utils::getType($namespace).'"');
        }
        return new UUID(self::_v3($namespace, $name));
    }

    /**
     * Constructs new UUID instance with generated version 4 UUID (random)
     * @return \NGS\UUID
     */
    public static function v4()
    {
        return new UUID(self::_v4());
    }

    /**
     * Constructs new UUID instance with generated version 5 UUID (SHA-1 hash)
     * @param    string|\NGS\UUID uuid $namespace
     * @param    string    $name
     * @return \NGS\UUID
     * @throws \InvalidArgumentException
     */
    public static function v5($namespace, $name)
    {
        if ($namespace instanceof \NGS\UUID) {
            $namespace = $namespace->value;
        }
        elseif (!is_string($namespace)) {
            throw new \InvalidArgumentException('Cannot create uuid v5 from invalid namespace type: "'.Utils::getType($namespace).'"');
        }
        if(!is_string($name)) {
            throw new \InvalidArgumentException('Cannot create uuid v5 from invalid name type: "'.Utils::getType($namespace).'"');
        }
        return new UUID(self::_v5($namespace, $name));
    }

    /**
     * Gets UUID string value
     * @return string
     */
    public function __toString()
    {
        return $this->value;
    }

    /**
     * Validates UUID string
     * @param string $uuid
     * @return bool
     */
    public static function isValid($uuid)
    {
        if (!is_string($uuid)) {
            throw new \InvalidArgumentException('UUID value was not a string, type was: '.\NGS\Utils::gettype($uuid));
        }
        return preg_match('/^\{?[0-9a-f]{8}\-?[0-9a-f]{4}\-?[0-9a-f]{4}\-?'.
            '[0-9a-f]{4}\-?[0-9a-f]{12}\}?$/i', $uuid) === 1;
    }

    /**
     * Generate v3 UUID
     *
     * Version 3 UUIDs are named based. They require a namespace (another
     * valid UUID) and a value (the name). Given the same namespace and
     * name, the output is always the same.
     *
     * @param    uuid    $namespace
     * @param    string    $name
     */
    private static function _v3($namespace, $name)
    {
        if(!self::isValid($namespace)) {
            throw new \InvalidArgumentException('Cannot create uuid v3 from invalid namespace with value: "'.$namespace.'"');
        }

        // Get hexadecimal components of namespace
        $nhex = str_replace(array('-','{','}'), '', $namespace);

        // Binary Value
        $nstr = '';

        // Convert Namespace UUID to bits
        for($i = 0; $i < strlen($nhex); $i+=2)
        {
            $nstr .= chr(hexdec($nhex[$i].$nhex[$i+1]));
        }

        // Calculate hash value
        $hash = md5($nstr . $name);

        return sprintf('%08s-%04s-%04x-%04x-%12s',

            // 32 bits for "time_low"
            substr($hash, 0, 8),

            // 16 bits for "time_mid"
            substr($hash, 8, 4),

            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 3
            (hexdec(substr($hash, 12, 4)) & 0x0fff) | 0x3000,

            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            (hexdec(substr($hash, 16, 4)) & 0x3fff) | 0x8000,

            // 48 bits for "node"
            substr($hash, 20, 12)
        );
    }

    /**
     *
     * Generate v4 UUID
     *
     * Version 4 UUIDs are pseudo-random.
     */
    private static function _v4()
    {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',

            // 32 bits for "time_low"
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),

            // 16 bits for "time_mid"
            mt_rand(0, 0xffff),

            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand(0, 0x0fff) | 0x4000,

            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand(0, 0x3fff) | 0x8000,

            // 48 bits for "node"
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }

    /**
     * Generate v5 UUID
     *
     * Version 5 UUIDs are named based. They require a namespace (another
     * valid UUID) and a value (the name). Given the same namespace and
     * name, the output is always the same.
     *
     * @param    uuid    $namespace
     * @param    string    $name
     */
    private static function _v5($namespace, $name)
    {
        if(!self::isValid($namespace)) {
            throw new \InvalidArgumentException('Cannot create uuid v5 from invalid namespace with value: "'.$namespace.'"');
        }

        // Get hexadecimal components of namespace
        $nhex = str_replace(array('-','{','}'), '', $namespace);

        // Binary Value
        $nstr = '';

        // Convert Namespace UUID to bits
        for($i = 0; $i < strlen($nhex); $i+=2)
        {
            $nstr .= chr(hexdec($nhex[$i].$nhex[$i+1]));
        }

        // Calculate hash value
        $hash = sha1($nstr . $name);

        return sprintf('%08s-%04s-%04x-%04x-%12s',

            // 32 bits for "time_low"
            substr($hash, 0, 8),

            // 16 bits for "time_mid"
            substr($hash, 8, 4),

            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 5
            (hexdec(substr($hash, 12, 4)) & 0x0fff) | 0x5000,

            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            (hexdec(substr($hash, 16, 4)) & 0x3fff) | 0x8000,

            // 48 bits for "node"
            substr($hash, 20, 12)
        );
    }
}
