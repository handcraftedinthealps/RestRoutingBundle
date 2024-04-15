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

namespace HandcraftedInTheAlps\RestRoutingBundle\DependencyInjection\CompilerPass;

use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

/**
 * @internal
 */
class AnnotationReaderPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        if ($container->hasDefinition('handcraftedinthealps_rest_routing.annotation_reader')) {
            return;
        }

        $definition = new Definition(AnnotationReader::class);
        $definition->addMethodCall('addGlobalIgnoredName', ['required']);
        $container->setDefinition('handcraftedinthealps_rest_routing.annotation_reader', $definition);
    }
}
