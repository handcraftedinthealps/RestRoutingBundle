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

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;;

/**
 * This class contains the configuration information for the bundle.
 *
 * This information is solely responsible for how the different configuration
 * sections are normalized, and merged.
 *
 * @author Lukas Kahwe Smith <smith@pooteeweet.org>
 *
 * @internal
 */
final class Configuration implements ConfigurationInterface
{
    private $debug;

    public function __construct(bool $debug)
    {
        $this->debug = $debug;
    }

    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('fos_rest_routing');

        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
                ->arrayNode('routing_loader')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('default_format')->defaultNull()->end()
                        ->scalarNode('prefix_methods')->defaultTrue()->end()
                        ->scalarNode('include_format')->defaultTrue()->end()
                        ->arrayNode('formats')
                            ->useAttributeAsKey('name')
                            ->defaultValue(['json' => true, 'xml' => true])
                            ->prototype('boolean')->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('service')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('annotation_reader')->defaultValue('annotation_reader')->end()
                        ->scalarNode('inflector')->defaultValue('fos_rest.routing.inflector.doctrine')->end()
                    ->end()
                ->end()
            ->end()
        ->end();

        return $treeBuilder;
    }
}
