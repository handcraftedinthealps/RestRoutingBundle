<?php

/*
 * This file is part of the FOSRestRoutingBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FOS\RestRoutingBundle\Tests\DependencyInjection;

use FOS\RestRoutingBundle\DependencyInjection\CompilerPass\FormatsCompilerPass;
use FOS\RestRoutingBundle\DependencyInjection\FOSRestRoutingExtension;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

/**
 * FOSRestRoutingExtension test.
 *
 * @author Bulat Shakirzyanov <avalanche123>
 * @author Konstantin Kudryashov <ever.zet@gmail.com>
 */
class FOSRestRoutingExtensionTest extends TestCase
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
                'fos_rest_routing' => [
                    'routing_loader' => [
                        'include_format' => false,
                    ],
                ],
            ]
        );

        $yamlCollectionLoaderDefinitionName = 'fos_rest.routing.loader.yaml_collection';
        $this->assertValidRestFileLoader(
            $this->container->getDefinition($yamlCollectionLoaderDefinitionName),
            false,
            $this->formats,
            $this->defaultFormat
        );

        $xmlCollectionLoaderDefinitionName = 'fos_rest.routing.loader.xml_collection';
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
                'fos_rest_routing' => [
                    'routing_loader' => [
                        'default_format' => 'xml',
                    ],
                ],
            ]
        );

        $yamlCollectionLoaderDefinitionName = 'fos_rest.routing.loader.yaml_collection';
        $this->assertValidRestFileLoader(
            $this->container->getDefinition($yamlCollectionLoaderDefinitionName),
            $this->includeFormat,
            $this->formats,
            'xml'
        );

        $xmlCollectionLoaderDefinitionName = 'fos_rest.routing.loader.xml_collection';
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
                'fos_rest_routing' => [
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

        $yamlCollectionLoaderDefinitionName = 'fos_rest.routing.loader.yaml_collection';
        $this->assertValidRestFileLoader(
            $this->container->getDefinition($yamlCollectionLoaderDefinitionName),
            $this->includeFormat,
            ['json' => true],
            'xml'
        );

        $xmlCollectionLoaderDefinitionName = 'fos_rest.routing.loader.xml_collection';
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
        $processorRef = new Reference('fos_rest.routing.loader.processor');
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
        $extension = new FOSRestRoutingExtension();
        $extension->load(
            $config,
            $this->container
        );

        $formatsCompilerPass = new FormatsCompilerPass();
        $formatsCompilerPass->process($this->container);
    }
}
