<?php

/*
 * This file is part of the FOSRestRoutingBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FOS\RestRoutingBundle\DependencyInjection\CompilerPass;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class FormatsCompilerPass  implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $formats = $container->getDefinition('fos_rest.routing.loader.yaml_collection')->getArgument(3);

        if (!empty($formats)) {
            // if formats are configured we do nothing
            return;
        }

        $formats = $this->getFOSRestBundleFormats($container);

        if (empty($formats)) {
            // set routing bundle defaults when not configured
            $formats = [
                'json' => true,
                'xml' => true
            ];
        }

        $container->getDefinition('fos_rest.routing.loader.yaml_collection')->replaceArgument(3, $formats);
        $container->getDefinition('fos_rest.routing.loader.xml_collection')->replaceArgument(3, $formats);
        $container->getDefinition('fos_rest.routing.loader.reader.action')->replaceArgument(4, $formats);
    }

    private function getFOSRestBundleFormats(ContainerBuilder $container): array
    {
        if (!$container->hasExtension('fos_rest')) {
            return [];
        }

        $formats = $container->getDefinition('fos_rest.view_handler.default')->getArgument(3);

        if (!is_array($formats)) {
            // FOSRestBundle 2.8
            $formats = $container->getDefinition('fos_rest.view_handler.default')->getArgument(4);
        }

        if (!is_array($formats)) {
            // could not detected FOSRestBundle formats
            return [];
        }

        foreach ($formats as $format => $enabled) {
            $formats[$format] = true;
        }

        return $formats;
    }
}
