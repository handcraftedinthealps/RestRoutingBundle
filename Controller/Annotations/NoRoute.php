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
            $this->setMethods((array)$this->getMethod());
        }
    }

    /**
     * @return string|null
     */
    public function getMethod()
    {
        return;
    }
}

if (!class_exists(OldNoRoute::class)) {
    class_alias(NoRoute::class, OldNoRoute::class);
}
