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

namespace HandcraftedInTheAlps\RestRoutingBundle\Routing;

use FOS\RestBundle\Routing\ClassResourceInterface as OldClassResourceInterface;

/**
 * Implement interface to define that missing resources in the methods should
 * use the class name to identify the resource.
 *
 * @author Lukas Kahwe Smith <smith@pooteeweet.org>
 */
interface ClassResourceInterface
{
}

if (!interface_exists(OldClassResourceInterface::class)) {
    class_alias(ClassResourceInterface::class, OldClassResourceInterface::class);
}
