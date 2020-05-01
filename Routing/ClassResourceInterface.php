<?php

/*
 * This file is part of Handcrafted in the Alps - Rest Routing Bundle Project.
 *
 * (c) Sulu GmbH <hello@sulu.io>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
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
