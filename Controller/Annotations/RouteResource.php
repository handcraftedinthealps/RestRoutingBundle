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
