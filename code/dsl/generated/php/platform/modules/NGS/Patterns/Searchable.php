<?php
namespace NGS\Patterns;

require_once(__DIR__.'/IDomainObject.php');
require_once(__DIR__.'/Specification.php');
require_once(__DIR__.'/../Client/DomainProxy.php');

use NGS\Client\DomainProxy;

abstract class Searchable implements IDomainObject
{
    public static function findAll($limit = null, $offset = null)
    {
        return DomainProxy::instance()->search(get_called_class(), $limit, $offset);
    }

    public static function count(Specification $specification = null)
    {
        return $specification === null
            ? DomainProxy::instance()->count(get_called_class())
            : $specification->count();
    }
}
