<?php

namespace Dddtest\SharedKernel\Application\Model\Service;

use Dddtest\SharedKernel\Application\RequestInterface;

interface UseCaseCommandInterface
{
    public function handle(RequestInterface $command);
}