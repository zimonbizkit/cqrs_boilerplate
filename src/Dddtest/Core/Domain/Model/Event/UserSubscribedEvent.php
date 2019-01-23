<?php

namespace Dddtest\Core\Domain\Model\Event;

use Dddtest\SharedKernel\Domain\Event\DomainEventInterface;

class UserSubscribedEvent implements DomainEventInterface
{
    const EMAIL_FIELD = 'email';
    const ID_FIELD = 'id';

    /** @var array */
    private $payload;

    public function __construct(array $payload)
    {
        $this->payload = $payload;
    }

    public function getPayloadField(string $field)
    {
        return $this->payload[$field];
    }
}