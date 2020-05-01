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
