<?php
namespace NGS;

require_once(__DIR__.'/Utils.php');
require_once(__DIR__.'/LocalDate.php');

use NGS\Utils;
use \InvalidArgumentException;
use \DateTimeZone;

/**
 * Date object with timezone
 */
class Timestamp
{
    // used when timezone is not specified
    const DEFAULT_TIMEZONE = 'UTC';
    const STRING_FORMAT = 'Y-m-d\\TH:i:s.uP';
    // use this format if default format fails
    const FALLBACK_FORMAT = 'Y-m-d\\TH:i:sP';

    private static $defaultTimezone;

    /**
     * @var \DateTime
     */
    protected $datetime;

    /**
     * Constructs a new Timestamp instance from microtime epoch
     *
     * @param int|float $utime numeric value with epoch time (with decimals representing milli & microseconds)
     * @param string $timezone string representation of a timezone
     *
     * @return \DateTime
     */
    private static function fromNumeric($utime, $timezone)
    {
        $strtime = sprintf('%.6f', $utime);

        $dt = \DateTime::createFromFormat('U.u', $strtime, new DateTimeZone($timezone));
        if($dt === false) {
            throw new \InvalidArgumentException('Cannot initialize "NGS\\Timestamp". Input number was in invalid format: "'.$utime.'"');
        }

        $dt->setTimezone(new DateTimeZone($timezone));
        return $dt;
    }

    /**
     * Constructs a new Timestamp instance from microtime epoch
     *
     * @param string $strtime string representation of the timestamp
     * @param string $timezone string representation of a timezone
     * @param string $pattern format in which to parse the timestamp
     *
     * @return \DateTime
     */
    private static function fromString($strtime, $timezone, $pattern)
    {
        try {
            $dtZone = new DateTimeZone($timezone);
            $dt = \DateTime::createFromFormat($pattern, $strtime, $dtZone);

            if($dt === false) {
                // try fallback format
                $dt = \DateTime::createFromFormat(self::FALLBACK_FORMAT, $strtime, $dtZone);

                if($dt === false) {
                    //let's try again
                    $dt = new \DateTime($strtime, $dtZone);
                    if(!$dt instanceof \DateTime) {
                        throw new \InvalidArgumentException('Cannot initialize "NGS\\Timestamp". Input string was in invalid format: "'.$strtime.'"');
                    }
                }
            }
        }
        catch(\Exception $ex) {
            // propagate our exception
            if ($ex instanceof InvalidArgumentException) {
                throw $ex;
            }
            // DateTime::__construct() can throw generic \Exception, rather
            // throw InvalidArgumentException
            throw new \InvalidArgumentException('Cannot initialize "NGS\\LocalDate". Input string was in invalid format: "'.$strtime.'"',
                null,
                $ex);
        }

        // workaround for known php bug, works only for 'UTC' timezone
        // https://bugs.php.net/bug.php?id=60873
        //$timezoneString = $dt->getTimezone()->getName();
        //if ($timezoneString==='+00:00') {
        //   $dt->setTimezone(new DateTimeZone('UTC'));
        //}
        return $dt;
    }

    /**
     * Set default timezone. New TimeStamp instances are set to default timezone
     *
     * @param string|\DateTimeZone $timezone
     * @throws \InvalidArgumentException
     * @return DateTimeZone
     */
    public static function setDefaultTimezone($timezone)
    {
        if (is_string($timezone)) {
            self::$defaultTimezone = new DateTimeZone($timezone);
        } elseif ($timezone instanceof \DateTimeZone) {
            self::$defaultTimezone = $timezone;
        } else {
            throw new InvalidArgumentException('Timezone was not a string or an instance of \\DateTimeZone');
        }
        return self::$defaultTimezone;
    }

    /**
     * Get default timezone
     *
     * @return DateTimeZone
     */
    public static function getDefaultTimezone()
    {
        if (!isset(self::$defaultTimezone)) {
            $timezoneString = date_default_timezone_get();
            self::$defaultTimezone = new DateTimeZone($timezoneString);
        }
        return self::$defaultTimezone;
    }

    /**
     * Constructs a new Timestamp instance
     *
     * @param \DateTime|\NGS\DateTime|string|int|float|null $value    Instance of \DateTime or \NGS\Timestamp, valid string format, timestamp as int/float, or null for current time
     * @param string                                        $pattern  format in which to parse the timestamp, defaults to 'Y-m-d\\TH:i:s.uP'
     * @param string                                        $timezone Set to override default timezone, string representation of a timezone, null defaults to 'UTC'
     * @throws \InvalidArgumentException
     */
    public function __construct($value = 'now', $pattern = self::STRING_FORMAT, $timezone = self::DEFAULT_TIMEZONE)
    {
        // current date
        if($value === 'now') {
            $value = microtime(true);
        }

        if($pattern === null) {
            $pattern = self::STRING_FORMAT;
        }

        if($value instanceof \DateTime) {
            $this->datetime = clone $value;
        }
        elseif($value instanceof \NGS\Timestamp) {
            $this->datetime = $value->toDateTime();
        }
        elseif($value instanceof \NGS\LocalDate) {
            $this->datetime = $value->toDateTime();
        }
        else if(is_int($value) || is_float($value)) {
            $this->datetime = self::fromNumeric($value, $timezone);
        }
        elseif(is_string($value)) {
            $this->datetime = self::fromString($value, $timezone, $pattern);
        }
        else {
            throw new \InvalidArgumentException('Timestamp cannot be constructed from type "'.Utils::getType($value).'", valid types are \NGS\Timestamp, \DateTime, string, int, float or null (for current date/time).');
        }

        if($this->datetime === null) {
            throw new \InvalidArgumentException('Timestamp could not be constructed from type "'.Utils::getType($value).'" with value: "'.$value.'"');
        }

        $this->datetime->setTimezone(self::getDefaultTimezone());
    }

    /**
     * Constructs array of Timestamps from array of valid constructor arguments
     *
     * @param array $items
     * @return array
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
                } elseif (!$val instanceof \NGS\Timestamp) {
                    $results[] = new \NGS\Timestamp($val);
                } else {
                    $results[] = $val;
                }
            }
        }
        catch(\Exception $e) {
            throw new \InvalidArgumentException('Element at index '.$key.' could not be converted to Timestamp!', 42, $e);
        }
        return $results;
    }

    /**
     * Returns time in default format 'Y-m-d\\TH:i:s.uP'
     *
     * @return string formatted timestamp with time zone
     */
    public function __toString()
    {
        return $this->format(self::STRING_FORMAT);
    }

    /**
     * Returns time in default format 'Y-m-d\\TH:i:s.uP'
     *
     * @return string formatted timestamp with time zone
     */
    public function format($pattern)
    {
        return $this->datetime->format($pattern);
    }

    /**
     * Checks for equality against another Timestamp instance
     *
     * @param \NGS\Timestamp $other Instance of NGS\Timestamp
     */
    public function equals(\NGS\Timestamp $other)
    {
        return $this->datetime == $other->toDateTime();
    }

    /**
     * Gets time in Unix timestamp
     *
     * @return int Unix timestamp
     */
    public function toInt()
    {
        return $this->datetime->getTimestamp();
    }

    /**
     * Gets time in Unix timestamp with microseconds
     *
     * @return float Unix timestamp with microseconds
     */
    public function toFloat()
    {
        return (float) $this->datetime->format('U.u');
    }

    /**
     * Gets time value as Datetime instance
     *
     * @return \DateTime Time value as DateTime instance
     */
    public function toDateTime()
    {
        return clone $this->datetime;
    }

    /**
     * Gets as \NGS\LocalDate instance
     *
     * @return \NGS\LocalDate Time value as NGS\LocalDate instance
     */
    public function toLocalDate()
    {
        return new \NGS\LocalDate($this->datetime);
    }
}
