<?php
namespace NGS\Patterns;

require_once(__DIR__.'/../Client/DomainProxy.php');

use NGS\Client\DomainProxy;

/**
 * Domain event represents an meaningful business event that occurred in the system.
 * It is a message that back-end system knows how to process and that will
 * change the state of the system.
 * <p>
 * They are preferred way of manipulating data instead of simple CRUD
 * operations (create, update, delete).
 * Unlike {@see AggregateDomainEvent} which is tied to a change in a single
 * {@see AggregateRoot}, DomainEvent should be used when an action will result
 * in modifications to multiple aggregates, external call (like sending an email)
 * or some other action.
 * <p>
 * By default event will be applied immediately.
 * If {@code async} is used, event will be stored immediately but applied later.
 *
 * DomainEvent is defined in DSL with keyword {@code event}.
 *
 * <blockquote><pre>
 * module Todo {
 * aggregate Task;
 * event MarkDone {
 * Task task;
 * }
 * }
 * </pre></blockquote>
 */
abstract class DomainEvent
{
    /**
     * Submits event
     *
     * @return string Created event URI
     */
    public function submit()
    {
        $eventUri = DomainProxy::instance()->submitEvent($this);
        if (is_string($eventUri)) {
            $this->URI = $eventUri;
        }
        return $eventUri;
    }
}
