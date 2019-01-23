<?php

namespace Dddtest\SharedKernel\Infrastructure\Ui\Service;

use SimpleBus\Message\Bus\Middleware\FinishesHandlingMessageBeforeHandlingNext;
use SimpleBus\Message\Bus\Middleware\MessageBusSupportingMiddleware;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class ContainerAndBusAwareCommand extends Command
{
    protected $commandBus;

    protected $container;

    public function __construct(?string $name = null)
    {
        $this->commandBus = new MessageBusSupportingMiddleware();

        $this->configureContainer();
        $this->configureCommandBus();

        parent::__construct($name);
    }


    private function configureContainer()
    {
        $this->container = new ContainerBuilder();

        $loader = new YamlFileLoader(
            $this->container,
            new FileLocator(__DIR__)
        );

        $loader->load('./../../../../Core/Infraestructure/Resources/DependencyInjection/services.yml');

        $this->container->compile();
    }

    private function configureCommandBus()
    {
        $this->commandBus->appendMiddleware(new FinishesHandlingMessageBeforeHandlingNext());
    }
}