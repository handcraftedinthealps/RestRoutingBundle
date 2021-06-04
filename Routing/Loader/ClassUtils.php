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

namespace HandcraftedInTheAlps\RestRoutingBundle\Routing\Loader;

/**
 * @internal
 */
class ClassUtils
{
    public static function findClassInFile(string $file): ?string
    {
        $class = false;
        $namespace = false;
        $tokens = token_get_all(file_get_contents($file));

        if (\PHP_VERSION_ID >= 80000) {
            $namespaceToken = \T_NAME_QUALIFIED;
        } else {
            $namespaceToken = \T_STRING;
        }

        for ($i = 0, $count = \count($tokens); $i < $count; ++$i) {
            $token = $tokens[$i];
            if (!\is_array($token)) {
                continue;
            }

            if (true === $class && \T_STRING === $token[0]) {
                return $namespace . '\\' . $token[1];
            }

            if (true === $namespace && $namespaceToken === $token[0]) {
                $namespace = '';
                do {
                    $namespace .= $token[1];
                    $token = $tokens[++$i];
                } while ($i < $count && \is_array($token) && \in_array($token[0], [\T_NS_SEPARATOR, $namespaceToken], true));
            }

            if (\T_CLASS === $token[0]) {
                $class = true;
            }

            if (\T_NAMESPACE === $token[0]) {
                $namespace = true;
            }
        }

        return null;
    }
}
