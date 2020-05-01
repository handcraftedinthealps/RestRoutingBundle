<?php

/*
 * This file is part of Handcrafted in the Alps - Rest Routing Bundle Project.
 *
 * (c) Sulu GmbH <hello@sulu.io>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace HandcraftedInTheAlps\RestRoutingBundle\Tests\Fixtures\Controller\Directory;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UsersController extends AbstractController
{
    public function getUsersAction()
    {
    }

    // [GET] /users

    public function getUserAction($slug)
    {
    }

    // [GET] /users/{slug}

    public function postUsersAction()
    {
    }

    // [POST] /users

    public function putUserAction($slug)
    {
    }

    // [PUT] /users/{slug}
}
