<?php

namespace Dddtest\Core\Infraestructure\Repository;

use Dddtest\Core\Domain\Model\Entity\User;
use Dddtest\Core\Domain\Model\Repository\UserRepositoryInterface;
use Dddtest\SharedKernel\Domain\Entity\DomainEntityInterface;
use Dddtest\SharedKernel\Domain\Entity\EntityIdInterface;
use Dddtest\SharedKernel\Infrastructure\Repository\EntityFilestoreRepository;

class UserFilestoreRepository extends EntityFilestoreRepository implements UserRepositoryInterface
{
    public function get(EntityIdInterface $userId): User
    {
        // TODO: Implement get() method.
    }

    public function save(DomainEntityInterface $user): bool
    {
        return true;
    }
}