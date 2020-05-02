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

use Doctrine\Common\Inflector\Inflector;

/**
 * Inflector object using the Doctrine/Inflector.
 *
 * @author Mark Kazemier <Markkaz>
 */
final class DoctrineInflector implements InflectorInterface
{
    /**
     * {@inheritdoc}
     */
    public function pluralize(string $word): string
    {
        return Inflector::pluralize($word);
    }
}
