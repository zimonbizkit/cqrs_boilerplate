<?php

namespace Dddtest\SharedKernel\Infrastructure\Ui\Service;

use Dddtest\Core\Application\Model\Service\SubscribeUserCommandRequest;
use Dddtest\SharedKernel\Application\ResponseInterface;
use Dddtest\SharedKernel\Infrastructure\Service\ContainerTrait;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class ContainerAndBusAwareCommand extends Command
{
    use ContainerTrait;

    private const COMMAND_HANDLERS_BY_COMMAND_NAME = [
        SubscribeUserCommandRequest::class => 'dddtest.core.application.model.service.subscribe_user_use_case'
    ];

    /** @var Container */
    protected $container;

    public function __construct(?string $name = null)
    {
        $this->configureContainer();

        parent::__construct($name);
    }


    private function configureContainer()
    {
        $this->container = $this->buildAndCompileContainer();
    }

    public function dispatch($command): ResponseInterface
    {
        return $this->container->get(
            self::COMMAND_HANDLERS_BY_COMMAND_NAME[get_class($command)]
        )->handle($command);


    }
}