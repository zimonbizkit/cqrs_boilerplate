<?php

namespace Dddtest\SharedKernel\Infrastructure\Repository;

use Dddtest\SharedKernel\Domain\Entity\DomainEntityInterface;
use Dddtest\SharedKernel\Domain\Entity\EntityIdInterface;

class EntityFilestoreRepository
{
    public function get(EntityIdInterface $entityId)
    {
        // TODO: Implement get() method.
    }

    public function save(DomainEntityInterface $entity)
    {
        return true;
    }
}