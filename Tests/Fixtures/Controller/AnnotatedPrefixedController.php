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

use HandcraftedInTheAlps\RestRoutingBundle\Controller\Annotations\Prefix;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author Donald Tyler <chekote69@gmail.com>
 * @Prefix("aprefix")
 */
class AnnotatedPrefixedController extends AbstractController
{
    /**
     * [GET]     /aprefix/something.{_format}.
     */
    public function getSomethingAction(Request $request)
    {
    }
}
