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

use Doctrine\Common\Annotations\Annotation;
use FOS\RestBundle\Controller\Annotations\Version as OldVersion;

/**
 * Version Route annotation class.
 *
 * @Annotation
 * @Target("CLASS")
 */
class Version extends Annotation
{
}

if (!class_exists(OldVersion::class)) {
    class_alias(Version::class, OldVersion::class, false);
}
