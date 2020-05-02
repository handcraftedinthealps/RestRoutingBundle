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

namespace HandcraftedInTheAlps\RestRoutingBundle\Tests\Fixtures\Controller;

use FOS\RestBundle\Controller\Annotations\NamePrefix;
use FOS\RestBundle\Controller\Annotations\NoRoute;
use FOS\RestBundle\Controller\Annotations\Prefix;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @NamePrefix("old_type.")
 * @RouteResource("Article")
 * @Prefix("/prefix")
 */
class OldTypeHintedController implements ClassResourceInterface
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

    /**
     * @NoRoute
     */
    public function postAction(ServerRequestInterface $request, $id)
    {
    }
}
