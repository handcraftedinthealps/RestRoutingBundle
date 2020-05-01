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

use FOS\RestBundle\Controller\AbstractFOSRestController;
use HandcraftedInTheAlps\RestRoutingBundle\Controller\Annotations\RouteResource;

/**
 *  @RouteResource("Article", pluralize=false)
 */
class AnnotatedNonPluralizedArticleController extends AbstractFOSRestController
{
    /**
     * [GET] /article.
     */
    public function cgetAction()
    {
    }

    /**
     * [GET] /article/{slug}.
     *
     * @param $slug
     */
    public function getAction($slug)
    {
    }

    /**
     * [GET] /article/{slug}/comment.
     *
     * @param $slug
     */
    public function cgetCommentAction($slug)
    {
    }

    /**
     * [GET] /article/{slug}/comment/{slug}.
     *
     * @param $slug
     * @param $comment
     */
    public function getCommentAction($slug, $comment)
    {
    }
}
