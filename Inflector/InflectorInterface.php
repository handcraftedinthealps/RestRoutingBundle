<?php

/*
 * This file is part of Handcrafted in the Alps - Rest Routing Bundle Project.
 *
 * (c) Sulu GmbH <hello@sulu.io>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace HandcraftedInTheAlps\RestRoutingBundle\Inflector;

/**
 * Inflector interface.
 *
 * @author Mark Kazemier <Markkaz>
 */
interface InflectorInterface
{
    /**
     * Pluralizes noun.
     *
     * @return string
     */
    public function pluralize(string $word);
}
