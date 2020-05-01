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

class UserTopicCommentsController extends AbstractController
{
    public function getCommentsAction($slug, $title)
    {
    }

    // [GET] /users/{slug}/topics/{title}/comments

    public function putCommentAction($slug, $title, $id)
    {
    }

    // [PUT] /users/{slug}/topics/{title}/comments/{id}
}
