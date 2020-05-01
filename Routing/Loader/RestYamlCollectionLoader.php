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

use HandcraftedInTheAlps\RestRoutingBundle\Routing\RestRouteCollection;
use Symfony\Component\Config\FileLocatorInterface;
use Symfony\Component\Config\Resource\FileResource;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

/**
 * RestYamlCollectionLoader YAML file collections loader.
 *
 * @internal
 */
class RestYamlCollectionLoader extends YamlFileLoader
{
    protected $collectionParents = [];
    private $processor;
    private $includeFormat;
    private $formats;
    private $defaultFormat;

    /**
     * @param string[] $formats
     */
    public function __construct(
        FileLocatorInterface $locator,
        RestRouteProcessor $processor,
        bool $includeFormat = true,
        array $formats = [],
        string $defaultFormat = null
    ) {
        parent::__construct($locator);

        $this->processor = $processor;
        $this->includeFormat = $includeFormat;
        $this->formats = $formats;
        $this->defaultFormat = $defaultFormat;
    }

    /**
     * {@inheritdoc}
     */
    public function load($file, $type = null): RouteCollection
    {
        $path = $this->locator->locate($file);

        try {
            $config = Yaml::parse(file_get_contents($path));
        } catch (ParseException $e) {
            throw new \InvalidArgumentException(sprintf('The file "%s" does not contain valid YAML.', $path), 0, $e);
        }

        $collection = new RouteCollection();
        $collection->addResource(new FileResource($path));

        // empty file
        if (null === $config) {
            return $collection;
        }

        // not an array
        if (!\is_array($config)) {
            throw new \InvalidArgumentException(sprintf('The file "%s" must contain a Yaml mapping (an array).', $path));
        }

        // process routes and imports
        foreach ($config as $name => $config) {
            if (isset($config['resource'])) {
                $resource = $config['resource'];
                $prefix = isset($config['prefix']) ? $config['prefix'] : null;
                $namePrefix = isset($config['name_prefix']) ? $config['name_prefix'] : null;
                $parent = isset($config['parent']) ? $config['parent'] : null;
                $type = isset($config['type']) ? $config['type'] : null;
                $host = isset($config['host']) ? $config['host'] : null;
                $requirements = isset($config['requirements']) ? $config['requirements'] : [];
                $defaults = isset($config['defaults']) ? $config['defaults'] : [];
                $options = isset($config['options']) ? $config['options'] : [];
                $currentDir = \dirname($path);

                $parents = [];
                if (!empty($parent)) {
                    if (!isset($this->collectionParents[$parent])) {
                        throw new \InvalidArgumentException(sprintf('Cannot find parent resource with name %s', $parent));
                    }

                    $parents = $this->collectionParents[$parent];
                }

                $imported = $this->processor->importResource($this, $resource, $parents, $prefix, $namePrefix, $type, $currentDir);

                if ($imported instanceof RestRouteCollection) {
                    $parents[] = ($prefix ? $prefix . '/' : '') . $imported->getSingularName();
                    $prefix = null;
                    $namePrefix = null;

                    $this->collectionParents[$name] = $parents;
                }

                $imported->addRequirements($requirements);
                $imported->addDefaults($defaults);
                $imported->addOptions($options);

                if (!empty($host)) {
                    $imported->setHost($host);
                }

                $imported->addPrefix((string) $prefix);

                // Add name prefix from parent config files
                $imported = $this->addParentNamePrefix($imported, $namePrefix);

                $collection->addCollection($imported);
            } elseif (isset($config['path'])) {
                if ($this->includeFormat) {
                    // append format placeholder if not present
                    if (false === strpos($config['path'], '{_format}')) {
                        $config['path'] .= '.{_format}';
                    }

                    // set format requirement if configured globally
                    if (!isset($config['requirements']['_format']) && !empty($this->formats)) {
                        $config['requirements']['_format'] = implode('|', array_keys($this->formats));
                    }
                }

                // set the default format if configured
                if (null !== $this->defaultFormat) {
                    $config['defaults']['_format'] = $this->defaultFormat;
                }

                $this->parseRoute($collection, $name, $config, $path);
            } else {
                throw new \InvalidArgumentException(sprintf('Unable to parse the "%s" route.', $name));
            }
        }

        return $collection;
    }

    /**
     * {@inheritdoc}
     */
    public function supports($resource, $type = null): bool
    {
        return 'rest' === $type && \is_string($resource) &&
            \in_array(pathinfo($resource, PATHINFO_EXTENSION), ['yaml', 'yml'], true);
    }

    public function addParentNamePrefix(RouteCollection $collection, ?string $namePrefix): RouteCollection
    {
        if (null === $namePrefix || '' === ($namePrefix = trim($namePrefix))) {
            return $collection;
        }

        $iterator = $collection->getIterator();

        foreach ($iterator as $key1 => $route1) {
            $collection->add($namePrefix . $key1, $route1);
            $collection->remove($key1);
        }

        return $collection;
    }
}
