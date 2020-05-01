<?php

/*
 * This file is part of Handcrafted in the Alps - Rest Routing Bundle Project.
 *
 * (c) Sulu GmbH <hello@sulu.io>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace HandcraftedInTheAlps\RestRoutingBundle\Tests\DependencyInjection;

use HandcraftedInTheAlps\RestRoutingBundle\DependencyInjection\CompilerPass\FormatsCompilerPass;
use HandcraftedInTheAlps\RestRoutingBundle\DependencyInjection\RestRoutingExtension;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

/**
 * RestRoutingExtension test.
 *
 * @author Bulat Shakirzyanov <avalanche123>
 * @author Konstantin Kudryashov <ever.zet@gmail.com>
 */
class RestRoutingExtensionTest extends TestCase
{
    /**
     * @var ContainerBuilder
     */
    private $container;

    /**
     * @var bool
     */
    private $includeFormat;

    /**
     * @var array
     */
    private $formats;

    /**
     * @var string
     */
    private $defaultFormat;

    public function setUp(): void
    {
        $this->container = new ContainerBuilder();
        $this->container->setParameter('kernel.bundles', array('JMSSerializerBundle' => true));
        $this->container->setParameter('kernel.debug', false);
        $this->includeFormat = true;
        $this->defaultFormat = null;
        $this->formats = ['json' => true, 'xml' => true];
    }

    public function tearDown(): void
    {
        unset($this->container, $this->extension);
    }

    public function testIncludeFormatDisabled()
    {
        $this->load(
            [
                'handcraftedinthealps_rest_routing' => [
                    'routing_loader' => [
                        'include_format' => false,
                    ],
                ],
            ]
        );

        $yamlCollectionLoaderDefinitionName = 'handcraftedinthealps_rest_routing.loader.yaml_collection';
        $this->assertValidRestFileLoader(
            $this->container->getDefinition($yamlCollectionLoaderDefinitionName),
            false,
            $this->formats,
            $this->defaultFormat
        );

        $xmlCollectionLoaderDefinitionName = 'handcraftedinthealps_rest_routing.loader.xml_collection';
        $this->assertValidRestFileLoader(
            $this->container->getDefinition($xmlCollectionLoaderDefinitionName),
            false,
            $this->formats,
            $this->defaultFormat
        );
    }

    public function testDefaultFormat()
    {
        $this->load(
            [
                'handcraftedinthealps_rest_routing' => [
                    'routing_loader' => [
                        'default_format' => 'xml',
                    ],
                ],
            ]
        );

        $yamlCollectionLoaderDefinitionName = 'handcraftedinthealps_rest_routing.loader.yaml_collection';
        $this->assertValidRestFileLoader(
            $this->container->getDefinition($yamlCollectionLoaderDefinitionName),
            $this->includeFormat,
            $this->formats,
            'xml'
        );

        $xmlCollectionLoaderDefinitionName = 'handcraftedinthealps_rest_routing.loader.xml_collection';
        $this->assertValidRestFileLoader(
            $this->container->getDefinition($xmlCollectionLoaderDefinitionName),
            $this->includeFormat,
            $this->formats,
            'xml'
        );
    }

    public function testFormats()
    {
        $this->load(
            [
                'handcraftedinthealps_rest_routing' => [
                    'routing_loader' => [
                        'default_format' => 'xml',
                        'formats' => [
                            'xml' => false,
                            'json' => true,
                        ],
                    ],
                ],
            ]
        );

        $yamlCollectionLoaderDefinitionName = 'handcraftedinthealps_rest_routing.loader.yaml_collection';
        $this->assertValidRestFileLoader(
            $this->container->getDefinition($yamlCollectionLoaderDefinitionName),
            $this->includeFormat,
            ['json' => true],
            'xml'
        );

        $xmlCollectionLoaderDefinitionName = 'handcraftedinthealps_rest_routing.loader.xml_collection';
        $this->assertValidRestFileLoader(
            $this->container->getDefinition($xmlCollectionLoaderDefinitionName),
            $this->includeFormat,
            ['json' => true],
            'xml'
        );
    }

    /**
     * Assert that loader definition described properly.
     *
     * @param Definition $loader        loader definition
     * @param bool       $includeFormat whether or not the requested view format must be included in the route path
     * @param string[]   $formats       supported view formats
     * @param string     $defaultFormat default view format
     */
    private function assertValidRestFileLoader(
        Definition $loader,
        $includeFormat,
        $formats,
        $defaultFormat
    ) {
        $locatorRef = new Reference('file_locator');
        $processorRef = new Reference('handcraftedinthealps_rest_routing.loader.processor');
        $arguments = $loader->getArguments();

        $this->assertCount(5, $arguments);
        $this->assertEquals($locatorRef, $arguments[0]);
        $this->assertEquals($processorRef, $arguments[1]);
        $this->assertSame($includeFormat, $arguments[2]);
        $this->assertEquals($formats, $arguments[3]);
        $this->assertSame($defaultFormat, $arguments[4]);
        $this->assertArrayHasKey('routing.loader', $loader->getTags());
    }

    private function load(array $config): void
    {
        $extension = new RestRoutingExtension();
        $extension->load(
            $config,
            $this->container
        );

        $formatsCompilerPass = new FormatsCompilerPass();
        $formatsCompilerPass->process($this->container);
    }
}
