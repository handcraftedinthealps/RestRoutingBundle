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
