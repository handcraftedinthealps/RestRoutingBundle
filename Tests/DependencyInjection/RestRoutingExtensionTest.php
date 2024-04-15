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

namespace HandcraftedInTheAlps\RestRoutingBundle\Tests\DependencyInjection;

use HandcraftedInTheAlps\RestRoutingBundle\DependencyInjection\CompilerPass\AnnotationReaderPass;
use HandcraftedInTheAlps\RestRoutingBundle\DependencyInjection\CompilerPass\FormatsCompilerPass;
use HandcraftedInTheAlps\RestRoutingBundle\DependencyInjection\RestRoutingExtension;
use HandcraftedInTheAlps\RestRoutingBundle\Tests\Application\Kernel;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\DependencyInjection\FrameworkExtension;
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

    protected function setUp(): void
    {
        $this->container = new ContainerBuilder();
        $this->container->setParameter('kernel.bundles', ['JMSSerializerBundle' => true]);
        $this->container->setParameter('kernel.debug', false);
        $this->includeFormat = true;
        $this->defaultFormat = null;
        $this->formats = ['json' => true, 'xml' => true];
    }

    protected function tearDown(): void
    {
        unset($this->container, $this->extension);
    }

    public function testDefault()
    {
        $this->load([
            'handcraftedinthealps_rest_routing' => [],
        ], true);

        $this->assertNotNull($this->container->get('handcraftedinthealps_rest_routing.loader.directory'));
        $this->assertNotNull($this->container->get('handcraftedinthealps_rest_routing.loader.controller'));
        $this->assertNotNull($this->container->get('handcraftedinthealps_rest_routing.loader.processor'));
        $this->assertNotNull($this->container->get('handcraftedinthealps_rest_routing.loader.yaml_collection'));
        $this->assertNotNull($this->container->get('handcraftedinthealps_rest_routing.loader.xml_collection'));
        $this->assertNotNull($this->container->get('handcraftedinthealps_rest_routing.loader.reader.controller'));
        $this->assertNotNull($this->container->get('handcraftedinthealps_rest_routing.loader.reader.action'));
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
        $this->assertSame($formats, $arguments[3]);
        $this->assertSame($defaultFormat, $arguments[4]);
        $this->assertArrayHasKey('routing.loader', $loader->getTags());
    }

    private function load(array $config, bool $frameworkBundle = false): void
    {
        $extension = new RestRoutingExtension();
        $extension->load(
            $config,
            $this->container
        );

        if ($frameworkBundle) {
            $this->container->setParameter('kernel.project_dir', \dirname(__DIR__) . '/Application');
            $this->container->setParameter('kernel.container_class', 'ApplicationContainer');
            $this->container->set('kernel', new Kernel('test', false));
            $extension = new FrameworkExtension();
            $extension->load(
                [],
                $this->container
            );
        }

        $formatsCompilerPass = new FormatsCompilerPass();
        $formatsCompilerPass->process($this->container);

        $annotationReaderCompilerPass = new AnnotationReaderPass();
        $annotationReaderCompilerPass->process($this->container);
    }
}
