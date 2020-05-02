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
