<?php

/*
 * This file is part of Handcrafted in the Alps - Rest Routing Bundle Project.
 *
 * (c) Sulu GmbH <hello@sulu.io>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace HandcraftedInTheAlps\RestRoutingBundle\Controller\Annotations;

use FOS\RestBundle\Controller\Annotations\RouteResource as OldRouteResource;

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

if (!class_exists(OldRouteResource::class)) {
    class_alias(RouteResource::class, OldRouteResource::class);
}
