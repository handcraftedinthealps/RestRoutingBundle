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

class UserTopicCommentsController extends AbstractController
{
    /**
     * [GET] /users/{slug}/topics/{title}/comments.
     *
     * @param $slug
     * @param $title
     */
    public function getCommentsAction($slug, $title)
    {
    }

    /**
     * [PUT] /users/{slug}/topics/{title}/comments/{id}.
     *
     * @param $slug
     * @param $title
     * @param $id
     */
    public function putCommentAction($slug, $title, $id)
    {
    }

    /**
     * [POST] /users/{slug}/topics/{title}/comments/{id}/ban.
     *
     * @param $slug
     * @param $title
     * @param $id
     */
    public function banCommentAction($slug, $title, $id)
    {
    }

    // conventional HATEOAS actions below

    /**
     * [GET] /users/{slug}/topics/{title}/comments/new.
     *
     * @param $slug
     * @param $title
     */
    public function newCommentsAction($slug, $title)
    {
    }

    /**
     * [GET] /users/{slug}/topics/{title}/comments/edit.
     *
     * @param $slug
     * @param $title
     * @param $id
     */
    public function editCommentAction($slug, $title, $id)
    {
    }

    /**
     * [GET] /users/{slug}/topics/{title}/comments/remove.
     *
     * @param $slug
     * @param $title
     * @param $id
     */
    public function removeCommentAction($slug, $title, $id)
    {
    }
}
