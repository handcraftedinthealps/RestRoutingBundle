<?php

namespace HandcraftedInTheAlps\RestRoutingBundle\Tests\Application;

use HandcraftedInTheAlps\RestRoutingBundle\RestRoutingBundle;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class Kernel extends \Symfony\Component\HttpKernel\Kernel
{
    use MicroKernelTrait;

    public function registerBundles(): iterable
    {
        return [
            new RestRoutingBundle(),
        ];
    }

    protected function configureContainer(ContainerBuilder $container, LoaderInterface $loader): void
    {
    }

    protected function configureRoutes($routes): void
    {
    }
}
