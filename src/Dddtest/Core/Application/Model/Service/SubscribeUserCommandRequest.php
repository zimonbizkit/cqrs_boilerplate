<?php

namespace Dddtest\Core\Application\Model\Service;

use Dddtest\SharedKernel\Application\Model\Service\CommandRequest;

class SubscribeUserCommandRequest implements CommandRequest
{
    /** @var string */
    private $email;

    public function __construct($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }


}