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
