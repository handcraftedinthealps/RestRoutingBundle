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

use FOS\RestBundle\Request\ParamFetcher;
use Psr\Http\Message\MessageInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\ConstraintViolationList;

class UsersController extends AbstractController
{
    public function copyUserAction($id)
    {
    }

    /**
     * [PROPFIND] /users/{id}/props/{property}.
     *
     * @param $id
     * @param $property
     */
    public function propfindUserPropsAction($id, $property)
    {
    }

    /**
     * [PROPPATCH] /users/{id}/props/{property}.
     *
     * @param $id
     * @param $property
     */
    public function proppatchUserPropsAction($id, $property)
    {
    }

    /**
     * [MOVE] /users/{id}.
     *
     * @param $id
     */
    public function moveUserAction($id)
    {
    }

    /**
     * [MKCOL] /users.
     */
    public function mkcolUsersAction()
    {
    }

    /**
     * [OPTIONS] /users.
     */
    public function optionsUsersAction()
    {
    }

    /**
     * [GET] /users.
     */
    public function getUsersAction()
    {
    }

    /**
     * [GET] /users/{slug}.
     *
     * @param $slug
     */
    public function getUserAction($slug)
    {
    }

    /**
     * [POST] /users.
     */
    public function postUsersAction()
    {
    }

    /**
     * [PATCH] /users.
     */
    public function patchUsersAction()
    {
    }

    /**
     * [PUT] /users/{slug}.
     *
     * @param $slug
     */
    public function putUserAction($slug)
    {
    }

    /**
     * [PATCH] /users/{slug}.
     *
     * @param $slug
     */
    public function patchUserAction($slug)
    {
    }

    /**
     * [LOCK] /users/{slug}.
     *
     * @param $slug
     */
    public function lockUserAction($slug)
    {
    }

    public function unlockUserAction($slug)
    {
    }

    // [PATCH] /users/{slug}/unlock

    public function getUserCommentsAction($slug)
    {
    }

    /**
     * [GET] /users/{slug}/comments/{id}.
     *
     * @param $slug
     * @param $id
     */
    public function getUserCommentAction($slug, $id)
    {
    }

    /**
     * [DELETE] /users/{slug}/comments/{id}.
     *
     * @param $slug
     * @param $id
     */
    public function deleteUserCommentAction($slug, $id)
    {
    }

    /**
     * [PATCH] /users/{slug}/ban.
     *
     * @param $slug
     * @param $id
     */
    public function banUserAction($slug, $id)
    {
    }

    /**
     * [POST] /users/{slug}/comments/{id}/vote.
     *
     * @param $slug
     * @param $id
     */
    public function postUserCommentVoteAction($slug, $id)
    {
    }

    /**
     * NO route.
     */
    public function _userbarAction()
    {
    }

    /**
     * [GET] /users/check_username.
     */
    public function check_usernameUsersAction()
    {
    }

    // conventional HATEOAS actions below

    /**
     * [GET] /users/new.
     */
    public function newUsersAction()
    {
    }

    /**
     * [GET] /user/{slug}/edit.
     *
     * @param $slug
     */
    public function editUserAction($slug)
    {
    }

    /**
     * [GET] /user/{slug}/remove.
     *
     * @param $slug
     */
    public function removeUserAction($slug)
    {
    }

    /**
     * [GET] /users/{slug}/comments/new.
     *
     * @param $slug
     */
    public function newUserCommentsAction($slug)
    {
    }

    /**
     * [GET] /users/{slug}/comments/{id}/edit.
     *
     * @param $slug
     * @param $id
     */
    public function editUserCommentAction($slug, $id)
    {
    }

    /**
     * [GET] /users/{slug}/comments/{id}/remove.
     *
     * @param $slug
     * @param $id
     */
    public function removeUserCommentAction($slug, $id)
    {
    }

    /**
     * [PATCH] /users/{userId}/comments/{commentId}/hide.
     *
     * @param $userId
     * @param $commentId
     */
    public function hideUserCommentAction($userId, $commentId)
    {
    }

    /**
     * [GET] /foos/{foo}/bars.
     *
     * @param $foo
     */
    public function getFooBarsAction($foo)
    {
    }

    // Parameter of type Request should be ignored

    /**
     * [GET] /users/{slug}/votes.
     *
     * @param Request $request
     * @param $slug
     */
    public function getUserVotesAction(Request $request, $slug)
    {
    }

    /**
     * [GET] /users/{slug}/votes/{id}.
     *
     * @param Request $request
     * @param $slug
     * @param $id
     */
    public function getUserVoteAction(Request $request, $slug, $id)
    {
    }

    /**
     * [GET] /users/{slug}/foos.
     *
     * @param $slug
     * @param Request $request
     */
    public function getUserFoosAction($slug, Request $request)
    {
    }

    // Other ignored parameter types

    /**
     * [GET] /users/{slug}/bars.
     *
     * @param ParamFetcher $paramFetcher
     * @param $slug
     */
    public function getUserBarsAction(
        ParamFetcher $paramFetcher,
        MessageInterface $message,
        ParamConverter $paramConverter,
        SessionInterface $session,
        UserInterface $user,
        ConstraintViolationList $constraintViolationList,
        $slug
    ) {
    }

    /**
     * [GET] /categories.
     */
    public function getCategoriesAction()
    {
    }
}
