<?php
namespace NGS\Patterns;

require_once(__DIR__.'/Searchable.php');
require_once(__DIR__.'/IIdentifiable.php');
require_once(__DIR__.'/../Client/DomainProxy.php');
require_once(__DIR__.'/../Client/CrudProxy.php');
require_once(__DIR__.'/../Converter/PrimitiveConverter.php');

use NGS\Converter\PrimitiveConverter;
use NGS\Client\DomainProxy;
use NGS\Client\CrudProxy;

/**
 * Domain object uniquely represented by its URI.
 * Entity and snowflake are example of domain objects which are
 * identified by it's identity, instead of values.
 * While entity does not implement Identifiable, aggregate root does.
 */
abstract class Identifiable extends Searchable implements IIdentifiable
{
    /**
     * Finds one or more objects by one or more URIs.
     * @param string|array Single string or array of strings representing URIs
     * @return Object if single string is given, or array of objects
     * @throws NotFoundException When argument is a single string URI and object
     * is not found.
     */
    public static function find($uri)
    {
        if(is_array($uri)) {
            $uri = PrimitiveConverter::toStringArray($uri);
            return DomainProxy::instance()->find(get_called_class(), $uri);
        }
        $uri = PrimitiveConverter::toString($uri);
        return CrudProxy::instance()->read(get_called_class(), $uri);
    }

    /**
     * Checks if object with given URI exists. It won't throw an exception if
     * object is not found (as Identifiable::find would).
     * @param string $uri Object URI
     * @return bool True if object was found, false otherwise.
     */
    public static function exists($uri)
    {
        $uri = PrimitiveConverter::toString($uri);
        $res = self::find(array($uri));
        return !empty($res);
    }
}
