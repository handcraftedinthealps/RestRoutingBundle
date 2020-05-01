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

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @author Toni Van de Voorde <toni.vdv@gmail.com>
 */
class ParamConverterController
{
    /**
     * @ParamConverter("something", converter="fos_rest.request_body")
     *
     * @param Something $something
     */
    public function postSomethingAction(Something $something)
    {
    }
}

final class Something
{
    public $id;
}
