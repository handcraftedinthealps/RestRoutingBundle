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
