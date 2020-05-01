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

namespace HandcraftedInTheAlps\RestRoutingBundle\Tests\Routing\Loader;

use Doctrine\Common\Annotations\AnnotationReader;
use HandcraftedInTheAlps\RestRoutingBundle\Inflector\DoctrineInflector;
use FOS\RestBundle\Request\ParamReader;
use HandcraftedInTheAlps\RestRoutingBundle\Routing\Loader\Reader\RestActionReader;
use HandcraftedInTheAlps\RestRoutingBundle\Routing\Loader\Reader\RestControllerReader;
use HandcraftedInTheAlps\RestRoutingBundle\Routing\Loader\RestRouteLoader;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Yaml\Yaml;

/**
 * Base Loader testing class.
 *
 * @author Konstantin Kudryashov <ever.zet@gmail.com>
 */
abstract class LoaderTest extends TestCase
{
    /**
     * @var ContainerBuilder
     */
    protected $container;

    /**
     * Load routes etalon from yml fixture file under Tests\Fixtures directory.
     *
     * @param string $etalonName name of the YML fixture
     *
     * @return array
     */
    protected function loadEtalonRoutesInfo($etalonName)
    {
        return Yaml::parse(file_get_contents(__DIR__.'/../../Fixtures/Etalon/'.$etalonName));
    }

    private function getAnnotationReader()
    {
        return new AnnotationReader();
    }

    /**
     * Builds a RestRouteLoader.
     *
     * @param array $formats         available resource formats
     * @param bool  $hasMethodPrefix
     *
     * @return RestRouteLoader
     */
    protected function getControllerLoader(array $formats = [], $hasMethodPrefix = true)
    {
        // This check allows to override the container
        if (null === $this->container) {
            $this->container = $this->getMockBuilder(ContainerBuilder::class)
                ->disableOriginalConstructor()
                ->setMethods(['get', 'has'])
                ->getMock();
        }
        $l = $this->getMockBuilder(FileLocator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $annotationReader = $this->getAnnotationReader();
        $paramReader = null;
        if (class_exists(ParamReader::class)) {
            $paramReader = new ParamReader($annotationReader);
        }
        $inflector = new DoctrineInflector();

        $ar = new RestActionReader($annotationReader, $paramReader, $inflector, true, $formats, $hasMethodPrefix);
        $cr = new RestControllerReader($ar, $annotationReader);

        return new RestRouteLoader($this->container, $l, $cr, 'html');
    }
}
