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

namespace HandcraftedInTheAlps\RestRoutingBundle\Routing\Loader\Reader;

use Doctrine\Common\Annotations\Reader;
use FOS\RestBundle\Controller\Annotations\NamePrefix as OldNamePrefix;
use FOS\RestBundle\Controller\Annotations\Prefix as OldPrefix;
use FOS\RestBundle\Controller\Annotations\RouteResource as OldRouteResource;
use FOS\RestBundle\Controller\Annotations\Version as OldVersion;
use FOS\RestBundle\Routing\ClassResourceInterface as OldClassResourceInterface;
use HandcraftedInTheAlps\RestRoutingBundle\Controller\Annotations\NamePrefix;
use HandcraftedInTheAlps\RestRoutingBundle\Controller\Annotations\Prefix;
use HandcraftedInTheAlps\RestRoutingBundle\Controller\Annotations\RouteResource;
use HandcraftedInTheAlps\RestRoutingBundle\Controller\Annotations\Version;
use HandcraftedInTheAlps\RestRoutingBundle\Routing\ClassResourceInterface;
use HandcraftedInTheAlps\RestRoutingBundle\Routing\RestRouteCollection;
use Symfony\Component\Config\Resource\FileResource;

/**
 * REST controller reader.
 *
 * @author Konstantin Kudryashov <ever.zet@gmail.com>
 *
 * @internal
 */
class RestControllerReader
{
    private $actionReader;
    private $annotationReader;

    public function __construct(RestActionReader $actionReader, Reader $annotationReader)
    {
        $this->actionReader = $actionReader;
        $this->annotationReader = $annotationReader;
    }

    public function getActionReader(): RestActionReader
    {
        return $this->actionReader;
    }

    public function read(\ReflectionClass $reflectionClass): RestRouteCollection
    {
        $collection = new RestRouteCollection();
        $collection->addResource(new FileResource($reflectionClass->getFileName()));

        // read prefix annotation
        if ($annotation = $this->annotationReader->getClassAnnotation($reflectionClass, Prefix::class)) {
            $this->actionReader->setRoutePrefix($annotation->value);
        } elseif ($annotation = $this->annotationReader->getClassAnnotation($reflectionClass, OldPrefix::class)) {
            $this->actionReader->setRoutePrefix($annotation->value);
        }

        // read name-prefix annotation
        if ($annotation = $this->annotationReader->getClassAnnotation($reflectionClass, NamePrefix::class)) {
            $this->actionReader->setNamePrefix($annotation->value);
        } elseif ($annotation = $this->annotationReader->getClassAnnotation($reflectionClass, OldNamePrefix::class)) {
            $this->actionReader->setNamePrefix($annotation->value);
        }

        // read version annotation
        if ($annotation = $this->annotationReader->getClassAnnotation($reflectionClass, Version::class)) {
            $this->actionReader->setVersions($annotation->value);
        } elseif ($annotation = $this->annotationReader->getClassAnnotation($reflectionClass, OldVersion::class)) {
            $this->actionReader->setVersions($annotation->value);
        }

        $resource = [];
        // read route-resource annotation
        if ($annotation = $this->annotationReader->getClassAnnotation($reflectionClass, RouteResource::class)) {
            $resource = explode('_', $annotation->resource);
            $this->actionReader->setPluralize($annotation->pluralize);
        } elseif ($annotation = $this->annotationReader->getClassAnnotation($reflectionClass, OldRouteResource::class)) {
            $resource = explode('_', $annotation->resource);
            $this->actionReader->setPluralize($annotation->pluralize);
        } elseif ($reflectionClass->implementsInterface(ClassResourceInterface::class)
            || $reflectionClass->implementsInterface(OldClassResourceInterface::class)
        ) {
            $resource = preg_split(
                '/([A-Z][^A-Z]*)Controller/',
                $reflectionClass->getShortName(),
                -1,
                \PREG_SPLIT_NO_EMPTY | \PREG_SPLIT_DELIM_CAPTURE
            );
            if (empty($resource)) {
                throw new \InvalidArgumentException("Controller '{$reflectionClass->name}' does not identify a resource");
            }
        }

        $prefix = $this->actionReader->getRoutePrefix();
        // trim '/' at the start of the prefix
        if ($prefix && '/' === substr($prefix, 0, 1)) {
            $this->actionReader->setRoutePrefix(substr($prefix, 1));
        }

        // read action routes into collection
        foreach ($reflectionClass->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
            $this->actionReader->read($collection, $method, $resource);
        }

        $this->actionReader->setRoutePrefix(null);
        $this->actionReader->setNamePrefix(null);
        $this->actionReader->setVersions(null);
        $this->actionReader->setPluralize(null);
        $this->actionReader->setParents([]);

        return $collection;
    }
}
