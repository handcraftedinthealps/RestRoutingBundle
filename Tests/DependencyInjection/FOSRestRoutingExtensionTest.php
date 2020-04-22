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
     * @var FOSRestRoutingExtension
     */
    private $extension;

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
        $this->extension = new FOSRestRoutingExtension();
        $this->includeFormat = true;
        $this->defaultFormat = null;
    }

    public function tearDown(): void
    {
        unset($this->container, $this->extension);
    }

    public function testIncludeFormatDisabled()
    {
        $this->extension->load(
            [
                'fos_rest_routing' => [
                    'routing_loader' => [
                        'include_format' => false,
                    ],
                ],
            ],
            $this->container
        );

        $yamlCollectionLoaderDefinitionName = 'fos_rest.routing.loader.yaml_collection';
        $this->assertValidRestFileLoader(
            $this->container->getDefinition($yamlCollectionLoaderDefinitionName),
            false,
            $this->defaultFormat
        );

        $xmlCollectionLoaderDefinitionName = 'fos_rest.routing.loader.xml_collection';
        $this->assertValidRestFileLoader(
            $this->container->getDefinition($xmlCollectionLoaderDefinitionName),
            false,
            $this->defaultFormat
        );
    }

    public function testDefaultFormat()
    {
        $this->extension->load(
            [
                'fos_rest_routing' => [
                    'routing_loader' => [
                        'default_format' => 'xml',
                    ],
                ],
            ],
            $this->container
        );

        $yamlCollectionLoaderDefinitionName = 'fos_rest.routing.loader.yaml_collection';
        $this->assertValidRestFileLoader(
            $this->container->getDefinition($yamlCollectionLoaderDefinitionName),
            $this->includeFormat,
            'xml'
        );

        $xmlCollectionLoaderDefinitionName = 'fos_rest.routing.loader.xml_collection';
        $this->assertValidRestFileLoader(
            $this->container->getDefinition($xmlCollectionLoaderDefinitionName),
            $this->includeFormat,
            'xml'
        );
    }

    /**
     * Assert that loader definition described properly.
     *
     * @param Definition $loader        loader definition
     * @param bool       $includeFormat whether or not the requested view format must be included in the route path
     * @param string     $defaultFormat default view format
     */
    private function assertValidRestFileLoader(
        Definition $loader,
        $includeFormat,
        $defaultFormat
    ) {
        $locatorRef = new Reference('file_locator');
        $processorRef = new Reference('fos_rest.routing.loader.processor');
        $arguments = $loader->getArguments();

        $this->assertCount(5, $arguments);
        $this->assertEquals($locatorRef, $arguments[0]);
        $this->assertEquals($processorRef, $arguments[1]);
        $this->assertSame($includeFormat, $arguments[2]);
        $this->assertSame($defaultFormat, $arguments[4]);
        $this->assertArrayHasKey('routing.loader', $loader->getTags());
    }

    private function assertAlias($value, $key)
    {
        $this->assertEquals($value, (string) $this->container->getAlias($key), sprintf('%s alias is correct', $key));
    }
}
