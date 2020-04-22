<?php

/*
 * This file is part of the FOSRestRoutingBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FOS\RestRoutingBundle\Tests\Routing\Loader;

use FOS\RestRoutingBundle\Routing\Loader\DirectoryRouteLoader;
use FOS\RestRoutingBundle\Routing\Loader\RestRouteProcessor;
use FOS\RestRoutingBundle\Tests\Fixtures\Controller\UsersController;
use Symfony\Component\Config\FileLocatorInterface;
use Symfony\Component\Config\Loader\LoaderResolver;
use Symfony\Component\Routing\Route;

class DirectoryRouteLoaderTest extends LoaderTest
{
    public function testLoad()
    {
        $collection = $this->loadFromDirectory(__DIR__.'/../../Fixtures/Controller/Directory');

        $this->assertCount(9, $collection);

        foreach ($collection as $route) {
            $this->assertInstanceOf(Route::class, $route);
        }
    }

    /**
     * @dataProvider supportsDataProvider
     */
    public function testSupports($resource, $type, $expected)
    {
        $loader = new DirectoryRouteLoader($this->getMockBuilder(FileLocatorInterface::class)->getMock(), new RestRouteProcessor());

        if ($expected) {
            $this->assertTrue($loader->supports($resource, $type));
        } else {
            $this->assertFalse($loader->supports($resource, $type));
        }
    }

    public function supportsDataProvider()
    {
        return array(
            'existing-directory' => array(__DIR__.'/../../Fixtures/Controller', 'rest', true),
            'non-existing-directory' => array(__DIR__.'/Fixtures/Controller', 'rest', false),
            'class-name' => array(UsersController::class, 'rest', false),
            'null-type' => array(__DIR__.'/../../Fixtures/Controller', null, false),
        );
    }

    private function loadFromDirectory($resource)
    {
        $directoryLoader = new DirectoryRouteLoader($this->getMockBuilder(FileLocatorInterface::class)->getMock(), new RestRouteProcessor());
        $controllerLoader = $this->getControllerLoader();

        // LoaderResolver sets the resolvers on the loaders passed to it
        new LoaderResolver(array($directoryLoader, $controllerLoader));

        return $directoryLoader->load($resource, 'rest');
    }
}
