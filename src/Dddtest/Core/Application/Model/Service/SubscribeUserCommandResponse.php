<?php

namespace Dddtest\Core\Application\Model\Service;

use Dddtest\SharedKernel\Application\Model\Service\CommandResponseInterface;

class SubscribeUserCommandResponse implements CommandResponseInterface
{
    private $status;
    private $response;

    public function __construct($status, $response)
    {
        $this->status = $status;
        $this->response = $response;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getResponse()
    {
        return $this->response;
    }
}