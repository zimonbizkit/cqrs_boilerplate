<?php

namespace Dddtest\SharedKernel\Application\Model\Service;

use Dddtest\SharedKernel\Application\ResponseInterface;

interface CommandResponseInterface extends ResponseInterface
{
    public function getStatus();

    public function getResponse();
}