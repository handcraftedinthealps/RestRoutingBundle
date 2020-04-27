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
use FOS\RestBundle\Controller\Annotations\Prefix as OldPrefix;

/**
 * Prefix Route annotation class.
 *
 * @Annotation
 * @Target("CLASS")
 */
class Prefix extends Annotation
{
}

if (!class_exists(OldPrefix::class)) {
    class_alias(Prefix::class, OldPrefix::class, false);
}
