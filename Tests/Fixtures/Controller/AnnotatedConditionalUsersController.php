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

use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Head;
use FOS\RestBundle\Controller\Annotations\Link;
use HandcraftedInTheAlps\RestRoutingBundle\Controller\Annotations\NoRoute;
use FOS\RestBundle\Controller\Annotations\Options;
use FOS\RestBundle\Controller\Annotations\Patch;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Controller\Annotations\Route;
use FOS\RestBundle\Controller\Annotations\Unlink;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use HandcraftedInTheAlps\RestRoutingBundle\Tests\Fixtures\User;

class AnnotatedConditionalUsersController extends AbstractController
{
    /**
     * [OPTIONS]     /users.
     */
    public function optionsUsersAction()
    {
    }

    /**
     * [OPTIONS]     /users.
     *
     * @Options
     */
    public function boptionsUsersAction()
    {
    }

    /**
     * [GET]     /users.
     */
    public function getUsersAction()
    {
    }

    /**
     * [GET]     /users/{slug}.
     *
     * @Route(requirements={"slug" = "[a-z]+"})
     */
    public function getUserAction(User $slug)
    {
    }

    /**
     * [PATCH]     /users.
     *
     * @Patch
     */
    public function patchUsersAction()
    {
    }

    /**
     * [GET]     /users/{slug}.
     *
     * @Patch(requirements={"slug" = "[a-z]+"})
     */
    public function patchUserAction($slug)
    {
    }

    /**
     * [GET]     /users/{slug}/comments/{id}.
     *
     * @Route(requirements={"slug" = "[a-z]+", "id" = "\d+"})
     */
    public function getUserCommentAction($slug, $id)
    {
    }

    /**
     * [POST]    /users/{slug}/rate.
     *
     * @Post(requirements={"slug" = "[a-z]+"})
     */
    public function rateUserAction($slug)
    {
    }

    /**
     * [PATCH, POST]     /users/{slug}/rate_comment/{id}.
     *
     * @Route("/users/{slug}/rate_comment/{id}", requirements={"slug" = "[a-z]+", "id" = "\d+"}, methods={"PATCH", "POST"})
     */
    public function rateUserCommentAction($slug, $id)
    {
    }

    /**
     * [GET]     /users/{slug}/bget.
     *
     * @Get
     */
    public function bgetUserAction($slug)
    {
    }

    /**
     * [POST]    /users/{slug}/bpost.
     *
     * @Post
     */
    public function bpostUserAction($slug)
    {
    }

    /**
     * [PUT]     /users/{slug}/bput.
     *
     * @Put
     */
    public function bputUserAction($slug)
    {
    }

    /**
     * [DELETE]  /users/{slug}/bdel.
     *
     * @Delete
     */
    public function bdelUserAction($slug)
    {
    }

    /**
     * [HEAD]    /users/{slug}/bhead.
     *
     * @Head
     */
    public function bheadUserAction($slug)
    {
    }

    /**
     * [LINK]    /users/{slug}/blink.
     *
     * @Link
     */
    public function bLinkUserAction($slug)
    {
    }

    /**
     * [UNLINK]    /users/{slug}/bunlink.
     *
     * @Unlink
     */
    public function bunlinkUserAction($slug)
    {
    }

    /**
     * @NoRoute
     */
    public function splitUserAction($slug)
    {
    }

    /**
     * [GET]     /users/{slug}/custom.
     *
     * @Route(requirements={"_format"="custom"})
     */
    public function customUserAction($slug)
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

    /**
     * @Link("/users1", name="_a_link_method", condition="context.getMethod() in ['LINK'] and request.headers.get('User-Agent') matches '/firefox/i'")
     * @Get("/users2",  name="_a_get_method", condition="context.getMethod() in ['GET'] and request.headers.get('User-Agent') matches '/firefox/i'")
     * @Get("/users3",  name="_an_other_get_method")
     * @Post("/users4",  name="_a_post_method", condition="context.getMethod() in ['POST'] and request.headers.get('User-Agent') matches '/firefox/i'")
     */
    public function multiplegetUsersAction()
    {
    }
}
