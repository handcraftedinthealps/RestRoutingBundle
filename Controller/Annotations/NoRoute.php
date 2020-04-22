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

use FOS\RestBundle\Controller\Annotations\Route;

/**
 * No Route annotation class.
 *
 * @Annotation
 * @Target({"METHOD","CLASS"})
 */
class NoRoute extends Route
{
}
