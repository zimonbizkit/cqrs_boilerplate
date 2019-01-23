<?php

namespace Dddtest\Core\Application\Model\Service;

use Dddtest\Core\Domain\Model\Service\SubscribeUserService;
use Dddtest\SharedKernel\Application\Model\Service\BaseUseCase;
use Dddtest\SharedKernel\Application\Model\Service\CommandRequest;
use Dddtest\SharedKernel\Application\Model\Service\UseCaseCommandInterface;

class SubscribeUserUseCase extends BaseUseCase implements UseCaseCommandInterface
{
    /** @var SubscribeUserService */
    private $subscribeUserService;

    public function __construct(SubscribeUserService $subscribeUserService)
    {
        $this->subscribeUserService = $subscribeUserService;
    }
    /** @param SubscribeUserCommandRequest | CommandRequest $command */
    public function handle(CommandRequest $command)
    {
        try {
            $user = $this->subscribeUserService->subscribe($command->getEmail());
            return new SubscribeUserCommandResponse(
                parent::STATUS_OK,
                [
                    'id' => $user->id(),
                    'email' => $user->email(),
                ]
            );
        } catch ( \Exception $e) {
            return new SubscribeUserCommandResponse(
                parent::STATUS_FAIL,
                [
                    'failMessage' => $e->getMessage()
                ]
            );
        }
    }
}