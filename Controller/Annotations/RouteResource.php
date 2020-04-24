<?php

/*
 * This file is part of the FOSRestRoutingBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FOS\RestRoutingBundle\Controller\Annotations;

use FOS\RestBundle\Controller\Annotations\RouteResource as OldRouteResource;

if (!class_exists(OldRouteResource::class)) {
    class_alias(RouteResource::class, OldRouteResource::class);
}

/**
 * RouteResource annotation class.
 *
 * @Annotation
 * @Target("CLASS")
 */
class RouteResource
{
    /**
     * @var string required
     */
    public $resource;

    /**
     * @var bool
     */
    public $pluralize = true;
}
