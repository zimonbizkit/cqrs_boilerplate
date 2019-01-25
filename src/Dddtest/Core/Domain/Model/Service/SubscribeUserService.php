<?php

namespace Dddtest\Core\Domain\Model\Service;

use Dddtest\Core\Domain\Model\Entity\User;
use Dddtest\SharedKernel\Domain\Service\IdentityProviderInterface;

class SubscribeUserService
{
    /** @var IdentityProviderInterface */
    private $identityProvider;

    public function __construct(
        IdentityProviderInterface $identityProvider
    ) {
        $this->identityProvider = $identityProvider;
    }

    public function subscribe(string $userEmail)
    {
        $user = User::subscribe(
            $this->identityProvider->provide(),
            $userEmail
        );

        return $user;
    }
}