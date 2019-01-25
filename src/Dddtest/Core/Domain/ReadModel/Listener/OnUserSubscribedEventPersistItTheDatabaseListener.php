<?php

namespace Dddtest\Core\Domain\ReadModel\Listener;

use Dddtest\Core\Domain\Model\Event\UserSubscribedEvent;
use Dddtest\Core\Domain\Model\Repository\UserDataRepositoryInterface;
use Dddtest\Core\Domain\ReadModel\Entity\UserData;
use Dddtest\SharedKernel\Domain\Event\DomainEventInterface;

class OnUserSubscribedEventPersistItTheDatabaseListener
{
    /** @var UserDataRepositoryInterface */
    private $userRepository;

    public function __construct(UserDataRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(DomainEventInterface $event)
    {
        $id = $event->getPayloadField(UserSubscribedEvent::ID_FIELD);
        $email = $event->getPayloadField(UserSubscribedEvent::EMAIL_FIELD);

        $userData = new UserData($id, $email);
        $this->userRepository->save($userData);
    }
}