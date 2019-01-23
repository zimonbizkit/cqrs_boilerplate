<?php

namespace Dddtest\SharedKernel\Infrastructure\Service;

use Dddtest\SharedKernel\Domain\Service\IdentityProviderInterface;
use Ramsey\Uuid\Uuid;

class UuidIdentityProvider implements IdentityProviderInterface
{
    public function provide(): string
    {
        return Uuid::uuid4();
    }
}