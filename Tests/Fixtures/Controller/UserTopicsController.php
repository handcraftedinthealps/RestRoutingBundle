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

class UserTopicsController extends AbstractController
{
    /**
     * [GET] /users/{slug}/topics.
     *
     * @param $slug
     */
    public function getTopicsAction($slug)
    {
    }

    /**
     * [GET] /users/{slug}/topics/{title}.
     *
     * @param $slug
     * @param $title
     */
    public function getTopicAction($slug, $title)
    {
    }

    /**
     * [PUT] /users/{slug}/topics/{title}.
     *
     * @param $slug
     * @param $title
     */
    public function putTopicAction($slug, $title)
    {
    }

    /**
     * [POST] /users/{slug}/topics/{title}/hide.
     *
     * @param $slug
     * @param $title
     */
    public function hideTopicAction($slug, $title)
    {
    }

    // conventional HATEOAS actions below

    /**
     * [GET] /users/{slug}/topics/new.
     *
     * @param $slug
     */
    public function newTopicsAction($slug)
    {
    }

    /**
     * [GET] /users/{slug}/topics/{title}/edit.
     *
     * @param $slug
     * @param $title
     */
    public function editTopicAction($slug, $title)
    {
    }

    /**
     * [GET] /remove/{slug}/topics/{title}/remove.
     *
     * @param $slug
     * @param $title
     */
    public function removeTopicAction($slug, $title)
    {
    }
}
