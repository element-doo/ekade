<?php
namespace NGS\Patterns;

require_once(__DIR__.'/IDomainObject.php');

interface IIdentifiable extends IDomainObject
{
    public function getURI();

    public static function find($uri);
}
