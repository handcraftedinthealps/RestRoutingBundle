<?php

/*
 * This file is part of Handcrafted in the Alps - Rest Routing Bundle Project.
 *
 * (c) Sulu GmbH <hello@sulu.io>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace HandcraftedInTheAlps\RestRoutingBundle\Tests\Fixtures\Controller;

use FOS\RestBundle\Controller\ControllerTrait;
use HandcraftedInTheAlps\RestRoutingBundle\Routing\ClassResourceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class InformationController extends AbstractController implements ClassResourceInterface
{
    use ControllerTrait;

    /**
     * [GET] /information.
     */
    public function cgetAction()
    {
    }
}
