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

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;

if (!file_exists($file = __DIR__ . '/../vendor/autoload.php')) {
    throw new \RuntimeException('Install the dependencies to run the test suite.');
}

$loader = require $file;

if (method_exists(AnnotationRegistry::class, 'registerLoader')) {
    AnnotationRegistry::registerLoader([$loader, 'loadClass']);
}

AnnotationReader::addGlobalIgnoredName('required');
