<?php

namespace Dddtest\Core\Domain\ReadModel\Listener;

use Dddtest\Core\Domain\Model\Event\UserSubscribedEvent;
use Dddtest\Core\Domain\Model\Repository\UserRepositoryInterface;
use Dddtest\Core\Domain\ReadModel\ValueObject\UserData;
use Dddtest\SharedKernel\Domain\Event\DomainEventInterface;

class OnUserSubscribedEventPersistItTheDatabaseListener
{
    /** @var UserRepositoryInterface */
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function persist(DomainEventInterface $event)
    {
        $id = $event->getPayloadField(UserSubscribedEvent::ID_FIELD);
        $email = $event->getPayloadField(UserSubscribedEvent::EMAIL_FIELD);

        $this->userRepository->save(new UserData($id, $email));
    }
}