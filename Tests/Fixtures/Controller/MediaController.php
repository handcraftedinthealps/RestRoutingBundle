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

class MediaController extends AbstractController implements ClassResourceInterface
{
    use ControllerTrait;

    /**
     * [GET] /media.
     */
    public function cgetAction()
    {
    }

    /**
     * [GET] /media/{slug}.
     *
     * @param $slug
     */
    public function getAction($slug)
    {
    }
}
