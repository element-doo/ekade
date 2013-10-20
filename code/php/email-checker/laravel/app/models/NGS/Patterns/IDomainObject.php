<?php
namespace NGS\Patterns;

interface IDomainObject
{
    public function toJson();
    public function toArray();
}
