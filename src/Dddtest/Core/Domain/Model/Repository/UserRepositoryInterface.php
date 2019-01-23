<?php

namespace Dddtest\Core\Domain\Model\Repository;

use Dddtest\Core\Domain\Model\User;
use Dddtest\SharedKernel\Domain\Entity\DomainEntityInterface;
use Dddtest\SharedKernel\Domain\Entity\EntityIdInterface;

interface UserRepositoryInterface
{
    public function get(EntityIdInterface $userId): User;

    public function save(DomainEntityInterface $user): bool;
}