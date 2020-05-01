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

class UserTopicsController extends AbstractController
{
    public function getTopicsAction($slug)
    {
    }

    // [GET] /users/{slug}/topics

    public function getTopicAction($slug, $title)
    {
    }

    // [GET] /users/{slug}/topics/{title}

    public function putTopicAction($slug, $title)
    {
    }

    // [PUT] /users/{slug}/topics/{title}
}
