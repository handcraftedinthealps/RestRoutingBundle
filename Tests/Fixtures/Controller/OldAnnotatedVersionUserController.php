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

use FOS\RestBundle\Controller\Annotations\Version;
use FOS\RestBundle\Controller\Annotations\Get;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Version({"v1", "v3"})
 */
class OldAnnotatedVersionUserController extends AbstractController
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
