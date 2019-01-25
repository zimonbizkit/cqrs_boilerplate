<?php

namespace Dddtest\SharedKernel\Domain\Service;

interface DomainEventPublisherInterface
{
    public function publish(array $events);
}