<?php

namespace Dddtest\Core\Infraestructure\Repository;

use Dddtest\Core\Domain\Model\Entity\User;
use Dddtest\Core\Domain\Model\Repository\UserDataRepositoryInterface;
use Dddtest\Core\Domain\ReadModel\Entity\UserData;
use Dddtest\SharedKernel\Domain\Entity\DomainEntityInterface;
use Dddtest\SharedKernel\Domain\Entity\EntityIdInterface;
use Dddtest\SharedKernel\Infrastructure\Repository\EntityFilestoreRepository;

class UserDataFilestoreDataRepository extends EntityFilestoreRepository implements UserDataRepositoryInterface
{
    public function exists(EntityIdInterface $userId): bool
    {
        parent::exists($userId, $this->getEntityClass());
    }

    public function save(DomainEntityInterface $userData)
    {
        parent::save($userData);
    }

    protected function getEntityClass()
    {
        return UserData::class;
    }
}