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

use HandcraftedInTheAlps\RestRoutingBundle\Controller\Annotations\RouteResource;
use HandcraftedInTheAlps\RestRoutingBundle\Routing\ClassResourceInterface;
use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @RouteResource("Article")
 */
class TypeHintedController implements ClassResourceInterface
{
    public function cgetAction(Request $request)
    {
    }

    public function cpostAction(MessageInterface $request)
    {
    }

    public function getAction(Request $request, $id)
    {
    }

    public function postAction(ServerRequestInterface $request, $id)
    {
    }
}
