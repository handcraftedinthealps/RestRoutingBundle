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

use Symfony\Component\Config\FileLocatorInterface;
use Symfony\Component\Config\Loader\Loader;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Routing\RouteCollection;

/**
 * Parse annotated controller classes from all files of a directory.
 *
 * @author Christian Flothmann <christian.flothmann@xabbuh.de>
 *
 * @internal
 */
class DirectoryRouteLoader extends Loader
{
    private $fileLocator;
    private $processor;

    public function __construct(FileLocatorInterface $fileLocator, RestRouteProcessor $processor)
    {
        $this->fileLocator = $fileLocator;
        $this->processor = $processor;
    }

    /**
     * {@inheritdoc}
     */
    public function load($resource, $type = null): RouteCollection
    {
        if (isset($resource[0]) && in_array($resource[0], ['@', '.'], true)) {
            $resource = $this->fileLocator->locate($resource);
        }

        if (!is_dir($resource)) {
            throw new \InvalidArgumentException(sprintf('Given resource of type "%s" is no directory.', $resource));
        }

        $collection = new RouteCollection();

        $finder = new Finder();

        foreach ($finder->in($resource)->name('*.php')->sortByName()->files() as $file) {
            if (null !== $class = ClassUtils::findClassInFile($file)) {
                $imported = $this->processor->importResource($this, $class, array(), null, null, 'rest');
                $collection->addCollection($imported);
            }
        }

        return $collection;
    }

    /**
     * {@inheritdoc}
     */
    public function supports($resource, $type = null): bool
    {
        if ('rest' !== $type || !is_string($resource)) {
            return false;
        }

        if (isset($resource[0]) && in_array($resource[0], ['@', '.'], true)) {
            $resource = $this->fileLocator->locate($resource);
        }

        return is_dir($resource);
    }
}
