<?php

/*
 * This file is part of the FOSRestRoutingBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FOS\RestRoutingBundle\Inflector;

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
