<?php

namespace Dddtest\SharedKernel\Infrastructure\Service;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

trait ContainerTrait
{
    public function getContainerService($serviceReference)
    {
        $container = $this->buildAndCompileContainer();

        return $container->get($serviceReference);
    }

    /**
     * @return ContainerBuilder
     */
    public function buildAndCompileContainer(): ContainerBuilder
    {
        $container = new ContainerBuilder();

        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__)
        );

        $loader->load('./../../../Core/Infraestructure/Resources/DependencyInjection/services.yml');

        $container->compile();
        return $container;
    }


}