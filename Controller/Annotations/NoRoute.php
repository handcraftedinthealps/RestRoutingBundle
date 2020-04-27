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
