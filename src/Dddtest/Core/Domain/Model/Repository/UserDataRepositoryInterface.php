<?php

namespace Dddtest\Core\Domain\Model\Repository;

use Dddtest\SharedKernel\Domain\Entity\DomainEntityInterface;
use Dddtest\SharedKernel\Domain\Entity\EntityIdInterface;

interface UserDataRepositoryInterface
{
    public function exists(EntityIdInterface $userId): bool;

    public function save(DomainEntityInterface $user);
}