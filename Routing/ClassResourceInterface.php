<?php

/*
 * This file is part of the FOSRestRoutingBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FOS\RestRoutingBundle\Routing;

use FOS\RestBundle\Routing\ClassResourceInterface as OldClassResourceInterface;

if (!class_exists(OldClassResourceInterface::class)) {
    class_alias(ClassResourceInterface::class, OldClassResourceInterface::class);
}

/**
 * Implement interface to define that missing resources in the methods should
 * use the class name to identify the resource.
 *
 * @author Lukas Kahwe Smith <smith@pooteeweet.org>
 */
interface ClassResourceInterface
{
}

