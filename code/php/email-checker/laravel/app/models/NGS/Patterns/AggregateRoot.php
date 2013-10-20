<?php
namespace NGS\Patterns;

require_once(__DIR__.'/Identifiable.php');
require_once(__DIR__.'/../Client/CrudProxy.php');

use NGS\Client\CrudProxy;
use NGS\Client\DomainProxy;
use NGS\Patterns\Identifiable;
use NGS\Patterns\AggregateDomainEvent;

/**
 * Aggregate root is a meaningful object in the domain.
 * It can be viewed as a write boundary for entities and value objects
 * that will maintain write consistency.
 * <p>
 * Usually it represents a single table, but can span several tables
 * and can be used like document or similar data structure.
 * Since every aggregate is also an entity, it has a unique
 * identification represented by its URI.
 * <p>
 * DSL example:
 * <blockquote><pre>
 * module Todo {
 *   aggregate Task {
 *     timestamp startedAt;
 *     timestamp? finishedAt;
 *     int? priority;
 *     List<Note> notes;
 *   }
 *   value Note {
 *     date entered;
 *     string remark;
 *   }
 * }
 * </pre></blockquote>
 */
abstract class AggregateRoot extends Identifiable
{
    /**
     * Persists object on the server.
     * Insert is performed if object's URI is not set, otherwise, if URI is set,
     * current object is updated.
     *
     * @return AggregateRoot Persisted object
     */
    public function persist()
    {
        return $this->getURI() === null
            ? CrudProxy::instance()->create($this)
            : CrudProxy::instance()->update($this);
    }

    /**
     * Deletes object from the server
     *
     * @return AggregateRoot Deleted object
     * @throws \LogicException If object instance was created, but not persisted
     */
    public function delete()
    {
        if ($this->URI===null) {
            throw new \LogicException('Cannot delete instance of root "'.get_class($this).'" because it\'s URI was null.');
        }
        return CrudProxy::instance()->delete(get_called_class(), $this->URI);
    }

    /**
     * Applies aggregate domain event on object
     *
     * @param \NGS\Patterns\AggregateDomainEvent $event
     * @return AggregateRoot New instance of AggregateRoot with updated values
     * after applying event
     * @throws \LogicException If object instance was created, but not persisted
     */
    public function apply(AggregateDomainEvent $event)
    {
        $proxy = DomainProxy::instance();
        if($this->URI===null) {
            throw new \LogicException('Event '.get_class($event).' cannot be applied on instance of root "'.get_class($this).'" because it\'s URI was null.');
        }
        return $proxy->submitAggregateEvent($event, $this->URI);
    }
}
