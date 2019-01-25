<?php

namespace Dddtest\SharedKernel\Infrastructure\Ui\Service;

use Dddtest\SharedKernel\Application\ResponseInterface;
use Symfony\Component\Console\Output\OutputInterface;

interface ResponseHandlerInterface
{
    public function handleResponse(ResponseInterface $response, OutputInterface $output);
}