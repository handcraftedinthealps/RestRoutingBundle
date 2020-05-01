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

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrdersController extends AbstractController
{
    /**
     * [GET] /foos.
     */
    public function getFoosAction()
    {
    }

    // conventional HATEOAS action after REST action

    /**
     * [GET] /foos/new.
     */
    public function newFoosAction()
    {
    }

    // conventional HATEOAS action before REST action

    /**
     * [GET] /bars/new.
     */
    public function newBarsAction()
    {
    }

    /**
     * [GET] /bars/custom.
     */
    public function getBarsCustomAction()
    {
    }

    /**
     * [GET] /bars/{slug}.
     *
     * @param $slug
     */
    public function getBarsAction($slug)
    {
    }
}
