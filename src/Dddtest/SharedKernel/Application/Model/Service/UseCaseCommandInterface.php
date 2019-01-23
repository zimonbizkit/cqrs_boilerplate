<?php

namespace Dddtest\SharedKernel\Application\Model\Service;

interface UseCaseCommandInterface
{
    public function handle(CommandRequest $command);
}