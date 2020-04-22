<?php

/*
 * This file is part of the FOSRestRoutingBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FOS\RestRoutingBundle\Tests\Fixtures\Controller\Directory;

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
