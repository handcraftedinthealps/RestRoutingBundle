<?php

/*
 * This file is part of Handcrafted in the Alps - Rest Routing Bundle Project.
 *
 * (c) 2011-2020 FriendsOfSymfony <http://friendsofsymfony.github.com/>
 * (c) 2020 Sulu GmbH <hello@sulu.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace HandcraftedInTheAlps\RestRoutingBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * @internal
 */
class RestRoutingExtension extends Extension
{
    public function getAlias(): string
    {
        return 'handcraftedinthealps_rest_routing';
    }

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

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));

        $loader->load('routing.xml');

        $formats = array_filter($config['routing_loader']['formats']);

        $container->getDefinition('handcraftedinthealps_rest_routing.loader.controller')->addArgument($config['routing_loader']['default_format']);

        $container->getDefinition('handcraftedinthealps_rest_routing.loader.yaml_collection')->replaceArgument(4, $config['routing_loader']['default_format']);
        $container->getDefinition('handcraftedinthealps_rest_routing.loader.xml_collection')->replaceArgument(4, $config['routing_loader']['default_format']);

        $container->getDefinition('handcraftedinthealps_rest_routing.loader.yaml_collection')->replaceArgument(2, $config['routing_loader']['include_format']);
        $container->getDefinition('handcraftedinthealps_rest_routing.loader.yaml_collection')->replaceArgument(3, $formats);
        $container->getDefinition('handcraftedinthealps_rest_routing.loader.xml_collection')->replaceArgument(2, $config['routing_loader']['include_format']);
        $container->getDefinition('handcraftedinthealps_rest_routing.loader.xml_collection')->replaceArgument(3, $formats);
        $container->getDefinition('handcraftedinthealps_rest_routing.loader.reader.action')->replaceArgument(3, $config['routing_loader']['include_format']);
        $container->getDefinition('handcraftedinthealps_rest_routing.loader.reader.action')->replaceArgument(4, $formats);
        $container->getDefinition('handcraftedinthealps_rest_routing.loader.reader.action')->replaceArgument(5, $config['routing_loader']['prefix_methods']);

        foreach ($config['service'] as $key => $service) {
            if (null !== $service) {
                $container->setAlias('handcraftedinthealps_rest_routing.' . $key, $service);
            }
        }
    }
}
