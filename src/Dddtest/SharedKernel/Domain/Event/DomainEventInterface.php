<?php

namespace Dddtest\SharedKernel\Domain\Event;

interface DomainEventInterface
{
    public function getPayloadField(string $field);
}