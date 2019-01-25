<?php

namespace Dddtest\Core\Application\Model\Service;

use Dddtest\Core\Domain\Model\Entity\User;
use Dddtest\Core\Domain\Model\Service\SubscribeUserService;
use Dddtest\SharedKernel\Application\Model\Service\BaseUseCase;
use Dddtest\SharedKernel\Application\Model\Service\CommandRequest;
use Dddtest\SharedKernel\Application\Model\Service\UseCaseCommandInterface;
use Dddtest\SharedKernel\Application\RequestInterface;
use Dddtest\SharedKernel\Domain\Service\DomainEventPublisherInterface;

class SubscribeUserUseCase extends BaseUseCase implements UseCaseCommandInterface
{
    /** @var SubscribeUserService */
    private $subscribeUserService;

    public function __construct(
        SubscribeUserService $subscribeUserService,
        DomainEventPublisherInterface $domainEventPublisher
    ) {
        $this->subscribeUserService = $subscribeUserService;
        parent::__construct($domainEventPublisher);
    }

    /** @param SubscribeUserCommandRequest | CommandRequest $command */
    public function handle(RequestInterface $command)
    {
        try {
            /** @var User $user */

            $user = $this->subscribeUserService->subscribe($command->getEmail());
            $this->domainEventPublisher->publish($user->getRecordedEvents());
            return new SubscribeUserCommandResponse(
                parent::STATUS_OK,
                [
                    'id' => $user->id()->value(),
                    'email' => $user->email()->value(),
                ]
            );
        } catch ( \Exception $e) {
            return new SubscribeUserCommandResponse(
                parent::STATUS_FAIL,
                [
                    'failMessage' => $e->getMessage(),
                    'trace' => $e->getTrace()
                ]
            );
        }
    }
}