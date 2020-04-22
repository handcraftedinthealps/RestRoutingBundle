<?php

/*
 * This file is part of the FOSRestRoutingBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use FOS\RestBundle\Controller\Annotations\RouteResource as OldRouteResource;
use FOS\RestRoutingBundle\Controller\Annotations\RouteResource;

use FOS\RestBundle\Controller\Annotations\NoRoute as OldNoRoute;
use FOS\RestRoutingBundle\Controller\Annotations\NoRoute;

use FOS\RestBundle\Controller\Annotations\Version as OldVersion;
use FOS\RestRoutingBundle\Controller\Annotations\Version;

use FOS\RestBundle\Controller\Annotations\Prefix as OldPrefix;
use FOS\RestRoutingBundle\Controller\Annotations\Prefix;

use FOS\RestBundle\Routing\ClassResourceInterface as OldClassResourceInterface;
use FOS\RestRoutingBundle\Routing\ClassResourceInterface;

if (!class_exists(OldRouteResource::class)) {
    class_alias(RouteResource::class, OldRouteResource::class);
}

if (!class_exists(OldNoRoute::class)) {
    class_alias(NoRoute::class, OldNoRoute::class);
}

if (!class_exists(OldVersion::class)) {
    class_alias(Version::class, OldVersion::class);
}

if (!class_exists(OldPrefix::class)) {
    class_alias(Prefix::class, OldPrefix::class);
}

if (!class_exists(OldClassResourceInterface::class)) {
    class_alias(ClassResourceInterface::class, OldClassResourceInterface::class);
}
