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
