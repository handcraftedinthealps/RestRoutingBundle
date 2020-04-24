<?php

/*
 * This file is part of the FOSRestRoutingBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FOS\RestRoutingBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * @internal
 */
class FOSRestRoutingExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function getConfiguration(array $config, ContainerBuilder $container): Configuration
    {
        return new Configuration($container->getParameter('kernel.debug'));
    }

    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = new Configuration($container->getParameter('kernel.debug'));
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));

        $loader->load('routing.xml');

        $formats = array_filter($config['routing_loader']['formats']);

        $container->getDefinition('fos_rest.routing.loader.controller')->addArgument($config['routing_loader']['default_format']);

        $container->getDefinition('fos_rest.routing.loader.yaml_collection')->replaceArgument(4, $config['routing_loader']['default_format']);
        $container->getDefinition('fos_rest.routing.loader.xml_collection')->replaceArgument(4, $config['routing_loader']['default_format']);

        $container->getDefinition('fos_rest.routing.loader.yaml_collection')->replaceArgument(2, $config['routing_loader']['include_format']);
        $container->getDefinition('fos_rest.routing.loader.yaml_collection')->replaceArgument(3, $formats);
        $container->getDefinition('fos_rest.routing.loader.xml_collection')->replaceArgument(2, $config['routing_loader']['include_format']);
        $container->getDefinition('fos_rest.routing.loader.xml_collection')->replaceArgument(3, $formats);
        $container->getDefinition('fos_rest.routing.loader.reader.action')->replaceArgument(3, $config['routing_loader']['include_format']);
        $container->getDefinition('fos_rest.routing.loader.reader.action')->replaceArgument(4, $formats);
        $container->getDefinition('fos_rest.routing.loader.reader.action')->replaceArgument(5, $config['routing_loader']['prefix_methods']);

        foreach ($config['service'] as $key => $service) {
            if (null !== $service) {
                $container->setAlias('fos_rest.routing.'.$key, $service);
            }
        }
    }
}
