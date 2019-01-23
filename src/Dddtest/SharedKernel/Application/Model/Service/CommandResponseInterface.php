<?php

namespace Dddtest\SharedKernel\Application\Model\Service;

interface CommandResponseInterface
{
    public function getStatus();

    public function getResponse();
}