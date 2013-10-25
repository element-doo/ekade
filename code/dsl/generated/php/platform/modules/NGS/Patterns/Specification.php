<?php
namespace NGS\Patterns;

require_once(__DIR__.'/IDomainObject.php');
require_once(__DIR__.'/../Client/DomainProxy.php');

use NGS\Client\DomainProxy;
use NGS\Name;

/**
 * Search predicate which can be used to filter domain objects from the remote server.
 *
 * Specification is defined in DSL with keyword {@code specification}
 * and a predicate.
 * Server can convert specification to SQL query on the fly or call
 * database function created at compile time. Other optimization techniques
 * can be used too.
 *
 * DSL example:
 * <blockquote><pre>
 * module Todo {
 *   aggregate Task {
 *     timestamp createdOn;
 *     specification findBetween
 *     'it => it.createdOn >= after && it.createdOn <= before' {
 *       date after;
 *       date before;
 *     }
 *   }
 * }
 * </pre></blockquote>
 *
 */
abstract class Specification implements IDomainObject
{
    /**
     * Search domain object using conditions in specification
     *
     * @param type $limit
     * @param type $offset
     * @param array $order
     * @return array Array of found objects, or empty array if none found
     */
    public function search($limit = null, $offset = null, array $order = null)
    {
        $domainObject = Name::parent($this);
        return DomainProxy::instance()->searchWithSpecification($domainObject, $this, $limit, $offset, $order);
    }

    /**
     * Count domain object using conditions in specification
     *
     * @return type
     */
    public function count()
    {
        return DomainProxy::instance()->countWithSpecification($this);
    }

    /**
     * Creates an instance of SearchBuilder from specification.
     *
     * @see NGS\Patterns\SearchBuilder
     * @return \NGS\Patterns\SearchBuilder
     */
    public function builder()
    {
        return new SearchBuilder($this);
    }
}
