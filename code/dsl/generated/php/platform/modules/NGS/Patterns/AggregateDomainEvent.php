<?php
namespace NGS\Patterns;

require_once(__DIR__.'/../Client/DomainProxy.php');
require_once(__DIR__.'/../Converter/PrimitiveConverter.php');

use NGS\Client\DomainProxy;
use NGS\Converter\PrimitiveConverter;

/**
 * DomainEvent which should be used when there is an action
 * to be applied on a single aggregate root.
 *
 * When {@see DomainEvent} affects only a single aggregate, then we can use
 * specialized aggregate domain event. This event can't have side effects outside
 * aggregate, which allows it to be replayed when it's asynchronous.
 * This is useful in write intensive scenarios to minimize write load in the database,
 * but will increase read load, because reading aggregate will have to read all it's
 * unapplied events and apply them during reconstruction.
 *
 * <p>
 * AggregateDomainEvent is defined in DSL with keyword {@code event}.
 * <blockquote><pre>
 * module Todo {
 *   aggregate Task;
 *   event&lt;Task&gt; MarkDone;
 * }
 * </pre></blockquote>
 */
abstract class AggregateDomainEvent
{
    /**
     * Applies event to aggregate root object
     *
     * @param \NGS\Patterns\AggregateRoot $value Aggregate instance on which
     * event will be applied
     * @return \NGS\Patterns\AggregateRoot Aggregate with updated values after
     * the event was executed
     * @throws \InvalidArgumentException
     */
    public function submit($value=null)
    {
        if ($value === null) {
            throw new \InvalidArgumentException("argument can't be null. It must be aggregate or it's uri");
        }
        if ($value instanceof AggregateRoot) {
            return  DomainProxy::instance()->submitAggregateEvent($this, $value->getURI());
        }
        return DomainProxy::instance()->submitAggregateEvent($this, PrimitiveConverter::toString($value));
    }
}
