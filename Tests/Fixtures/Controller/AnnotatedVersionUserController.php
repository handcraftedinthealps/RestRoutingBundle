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

use HandcraftedInTheAlps\RestRoutingBundle\Controller\Annotations\Version;
use FOS\RestBundle\Controller\Annotations\Get;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Version({"v1", "v3"})
 */
class AnnotatedVersionUserController extends AbstractController
{
    /**
     * [GET, HEAD]     /users/{slug}/v2.
     *
     * @Get()
     */
    public function v1UserAction()
    {
    }

    /**
     * [GET, HEAD]     /users/{slug}/conditional.
     *
     * @Get(condition="context.getMethod() in ['GET', 'HEAD'] and request.headers.get('User-Agent') matches '/firefox/i'")
     */
    public function conditionalUserAction()
    {
    }

    public function v3UserAction()
    {
    }

    /**
     * [GET, HEAD]     /{version}/users.
     *
     * @Get("/{version}/users")
     */
    public function getUsersAction()
    {
    }
}
