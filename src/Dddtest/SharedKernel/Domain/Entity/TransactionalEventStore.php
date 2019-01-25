<?php

namespace Dddtest\SharedKernel\Domain\Entity;

use Dddtest\SharedKernel\Domain\Event\DomainEventInterface;

trait TransactionalEventStore
{
    private $events = [];

    public function getRecordedEvents(): array
    {
        return $this->events;
    }

    public function recordEvent(DomainEventInterface $event)
    {
        $this->events [] = $event;
    }
}