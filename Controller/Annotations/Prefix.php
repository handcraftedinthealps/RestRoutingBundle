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
