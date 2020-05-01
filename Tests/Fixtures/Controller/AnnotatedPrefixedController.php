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
