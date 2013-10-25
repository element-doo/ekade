<?php
namespace NGS\Patterns;

use NGS\Client\RestHttp;
use NGS\Client\Exception\NotFoundException;
use NGS\Utils;
use Memcached;

/**
 * Description of Repository
 */
class Repository
{
    // array(class=>array(uri=>object instance))
    private $cache = array();

    /** @var NGS\Client\RestHttp */
    private $http;
    /** @var Memcached Memcached */
    private $memcached;
    private $prefix;
    private static $instance;

    /**
     * Get or sets static singleton instance
     */
    public static function instance(Repository $repository=null)
    {
        if ($repository === null) {
            return self::$instance ?: new Repository();
        }
        return self::$instance = $repository;
    }

    public function __construct(RestHttp $http=null, Memcached $memcached=null, $prefix='')
    {
        $this->http = $http !== null ? $http : RestHttp::instance();

        if ($memcached) {
            $this->memcached = $memcached;
        }

        if ($prefix !== '' && !is_string($prefix)) {
            throw new \InvalidArgumentException('Cache prefix name must be a string, invalid type was: "'.Utils::getType($prefix).'"');
        }
        $this->prefix = $prefix;
    }

    public function invalidate($class, $uris)
    {
        if (!is_string($class)) {
            throw new \InvalidArgumentException('Class name must be a string, invalid type was: "'.Utils::getType($class).'"');
        }
        if (isset($this->cache[$class])) {
            $memcachedName = $this->prefix.$class.':';
            if (is_array($uris)) {
                $names = array();
                foreach ($uris as $uri) {
                    unset($this->cache[$class][$uri]);
                    $names[] = $memcachedName.$uri;
                }
                if ($this->memcached) {
                    // only in PECL memcached >= 2.0.0
                    if (method_exists($this->memcached, 'deleteMulti')) {
                        $this->memcached->deleteMulti($names);
                    }
                    else {
                        foreach ($names as $name) {
                            $this->memcached->delete($name);
                        }
                    }
                }
            }
            else {
                $name = $memcachedName.$uris;
                unset($this->cache[$class][$uris]);
                $this->memcached->delete($name);
            }
        }
    }

    public function find($class, $uris)
    {
        if (!is_string($class)) {
            throw new \InvalidArgumentException('Class name was not a string, invalid type was : "'.Utils::getType($uris).'"');
        }
        if (is_array($uris)) {
            return $this->findMulti($class, $uris);
        }
        elseif(is_string($uris)) {
            $items = $this->findMulti($class, array($uris));
            if(!$items) {
                throw new NotFoundException('Cannot find object "'.$class.'" with URI "'.$uris.'"');
            }
            return $items[0];
        }
        else {
            throw new \InvalidArgumentException('Uris must be an array or string, invalid type was: "'.Utils::getType($uris).'"');
        }
    }

    private function findMulti($class, array $uris)
    {
        $results = array();
        $missingUris = array();

        if(!isset($this->cache[$class])) {
            $this->cache[$class] = array();
        }
        foreach ($uris as $uri) {
            if (isset($this->cache[$class][$uri])) {
                $results[$uri] = $this->cache[$class][$uri];
            }
            else {
                $missingUris[$uri] = $uri;
            }
        }
        if ($missingUris) {
            $memcachedName = $this->prefix.$class.':';
            if ($this->memcached) {
                $names = array();
                foreach ($missingUris as $uri) {
                    $names[] = $memcachedName.$uri;
                }
                $items = $this->memcached->getMulti($names);
                if ($items) {
                    foreach($items as $item) {
                        $results[$item->URI] = $item;
                        $this->cache[$class][$item->URI] = $item;
                        unset($missingUris[$item->URI]);
                    }
                }
            }
            if ($missingUris) {
                $items = $class::find($missingUris);
                $newItems = array();
                foreach($items as $item) {
                    $results[$item->URI] = $item;
                    $this->cache[$class][$item->URI] = $item;
                    $newItems[$memcachedName.$item->URI] = $item;
                }
                if($this->memcached) {
                    $this->memcached->setMulti($newItems);
                }
            }
        }

        $sortedResults = array();
        foreach ($uris as $uri) {
            if (isset($results[$uri])) {
                $sortedResults[] = $results[$uri];
            }
        }
        return $sortedResults;
    }
}

?>
