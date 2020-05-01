<?php

/*
 * This file is part of Handcrafted in the Alps - Rest Routing Bundle Project.
 *
 * (c) Sulu GmbH <hello@sulu.io>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace HandcraftedInTheAlps\RestRoutingBundle\Routing\Loader;

use Symfony\Component\Config\Loader\FileLoader;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\Routing\RouteCollection;

/**
 * Processes resource in provided loader.
 *
 * @author Donald Tyler <chekote69@gmail.com>
 * @author Konstantin Kudryashov <ever.zet@gmail.com>
 *
 * @internal
 */
class RestRouteProcessor
{
    public function importResource(
        LoaderInterface $loader,
        $resource,
        array $parents = [],
        string $routePrefix = null,
        string $namePrefix = null,
        string $type = null,
        string $currentDir = null
    ): RouteCollection {
        $loader = $loader->resolve($resource, $type);

        if ($loader instanceof FileLoader && null !== $currentDir) {
            $resource = $loader->getLocator()->locate($resource, $currentDir);
        } elseif ($loader instanceof RestRouteLoader) {
            $loader->getControllerReader()->getActionReader()->setParents($parents);
            $loader->getControllerReader()->getActionReader()->setRoutePrefix($routePrefix);
            $loader->getControllerReader()->getActionReader()->setNamePrefix($namePrefix);
        }

        return $loader->load($resource, $type);
    }
}
