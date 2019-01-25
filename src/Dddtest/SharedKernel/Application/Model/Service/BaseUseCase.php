<?php

namespace Dddtest\SharedKernel\Application\Model\Service;

use Dddtest\SharedKernel\Application\RequestInterface;
use Dddtest\SharedKernel\Domain\Service\DomainEventPublisherInterface;

abstract class BaseUseCase
{
    const STATUS_OK = 'OK';
    const STATUS_FAIL = 'FAIL';
    /**
     * @var DomainEventPublisherInterface
     */
    protected $domainEventPublisher;

    public function __invoke(RequestInterface $request)
    {
        $this->handle($request);
    }

    public function __construct(DomainEventPublisherInterface $domainEventPublisher)
    {
        $this->domainEventPublisher = $domainEventPublisher;
    }

    abstract public function handle(RequestInterface $request);
}