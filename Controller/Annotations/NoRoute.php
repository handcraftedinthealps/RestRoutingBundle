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

use FOS\RestBundle\Controller\Annotations\NoRoute as OldNoRoute;
use Symfony\Component\Routing\Annotation\Route as BaseRoute;

/**
 * No Route annotation class.
 *
 * @Annotation
 * @Target({"METHOD","CLASS"})
 */
class NoRoute extends BaseRoute
{
    public function __construct(array $data)
    {
        parent::__construct($data);

        if (!$this->getMethods()) {
            $this->setMethods((array) $this->getMethod());
        }
    }

    /**
     * @return string|null
     */
    public function getMethod()
    {
    }
}

if (!class_exists(OldNoRoute::class)) {
    class_alias(NoRoute::class, OldNoRoute::class);
}
