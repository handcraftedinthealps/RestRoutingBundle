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

namespace HandcraftedInTheAlps\RestRoutingBundle\Tests\Fixtures\Controller;

use FOS\RestBundle\Controller\ControllerTrait;
use HandcraftedInTheAlps\RestRoutingBundle\Routing\ClassResourceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\ConstraintViolationList;

class ArticleController extends AbstractController implements ClassResourceInterface
{
    use ControllerTrait;

    /**
     * [OPTIONS] /articles.
     */
    public function optionsAction()
    {
    }

    /**
     * [GET] /articles.
     */
    public function cgetAction(ConstraintViolationList $errors)
    {
    }

    /**
     * [GET] /articles/{slug}.
     *
     * @param $slug
     */
    public function getAction($slug)
    {
    }

    /**
     * [POST] /articles.
     */
    public function cpostAction()
    {
    }

    /**
     * [PATCH] /articles.
     */
    public function cpatchAction()
    {
    }

    /**
     * [PUT] /articles/{slug}.
     *
     * @param $slug
     */
    public function putAction($slug)
    {
    }

    /**
     * [PATCH] /articles/{slug}.
     *
     * @param $slug
     */
    public function patchAction($slug)
    {
    }

    /**
     * [LOCK] /articles/{slug}.
     *
     * @param $slug
     */
    public function lockAction($slug)
    {
    }

    /**
     * [GET] /articles/{slug}/comments.
     *
     * @param $slug
     */
    public function getCommentsAction($slug)
    {
    }

    /**
     * [GET] /articles/{slug}/comments/{id}.
     *
     * @param $slug
     * @param $id
     */
    public function getCommentAction($slug, $id)
    {
    }

    /**
     * [DELETE] /articles/{slug}/comments/{id}.
     *
     * @param $slug
     * @param $id
     */
    public function deleteCommentAction($slug, $id)
    {
    }

    /**
     * [PATCH] /articles/{slug}/ban.
     *
     * @param $slug
     * @param $id
     */
    public function banAction($slug, $id)
    {
    }

    /**
     * [POST] /articles/{slug}/comments/{id}/vote.
     *
     * @param $slug
     * @param $id
     */
    public function postCommentVoteAction($slug, $id)
    {
    }

    /**
     * NO route.
     */
    public function _articlebarAction()
    {
    }

    /**
     * [GET] /articles/check_articlename.
     */
    public function check_articlenameAction()
    {
    }

    // conventional HATEOAS actions below

    /**
     * [GET] /articles/new.
     */
    public function newAction()
    {
    }

    /**
     * [GET] /article/{slug}/edit.
     *
     * @param $slug
     */
    public function editAction($slug)
    {
    }

    /**
     * [GET] /article/{slug}/remove.
     *
     * @param $slug
     */
    public function removeAction($slug)
    {
    }

    /**
     * [GET] /articles/{slug}/comments/new.
     *
     * @param $slug
     */
    public function newCommentAction($slug)
    {
    }

    /**
     * [GET] /articles/{slug}/comments/{id}/edit.
     *
     * @param $slug
     * @param $id
     */
    public function editCommentAction($slug, $id)
    {
    }

    /**
     * [GET] /articles/{slug}/comments/{id}/remove.
     *
     * @param $slug
     * @param $id
     */
    public function removeCommentAction($slug, $id)
    {
    }

    /**
     * [PATCH] /articles/{articleId}/comments/{commentId}/hide.
     *
     * @param $articleId
     * @param $commentId
     */
    public function hideCommentAction($articleId, $commentId)
    {
    }

    // Parameter of type Request should be ignored

    /**
     * [GET] /articles/{slug}/votes.
     *
     * @param Request $request
     * @param $slug
     */
    public function getVotesAction(Request $request, $slug)
    {
    }

    /**
     * [GET] /articles/{slug}/votes/{id}.
     *
     * @param Request $request
     * @param $slug
     * @param $id
     */
    public function getVoteAction(Request $request, $slug, $id)
    {
    }

    /**
     * [GET] /articles/{slug}/foos.
     *
     * @param $slug
     * @param Request $request
     */
    public function getFoosAction($slug, Request $request)
    {
    }
}
