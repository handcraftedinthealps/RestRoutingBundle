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
use Symfony\Component\Config\Util\XmlUtils;
use Symfony\Component\Routing\Loader\XmlFileLoader;
use Symfony\Component\Routing\RouteCollection;

/**
 * RestXmlCollectionLoader XML file collections loader.
 *
 * @author Donald Tyler <chekote69@gmail.com>
 *
 * @internal
 */
class RestXmlCollectionLoader extends XmlFileLoader
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
    protected function parseNode(RouteCollection $collection, \DOMElement $node, $path, $file): void
    {
        switch ($node->tagName) {
            case 'route':
                $this->parseRoute($collection, $node, $path);

                break;
            case 'import':
                $name = (string) $node->getAttribute('id');
                $resource = (string) $node->getAttribute('resource');
                $prefix = (string) $node->getAttribute('prefix');
                $namePrefix = (string) $node->getAttribute('name-prefix');
                $parent = (string) $node->getAttribute('parent');
                $type = (string) $node->getAttribute('type');
                $host = isset($config['host']) ? $config['host'] : null;
                $currentDir = \dirname($path);

                $parents = [];
                if (!empty($parent)) {
                    if (!isset($this->collectionParents[$parent])) {
                        throw new \InvalidArgumentException(sprintf('Cannot find parent resource with name %s', $parent));
                    }

                    $parents = $this->collectionParents[$parent];
                }

                $imported = $this->processor->importResource($this, $resource, $parents, $prefix, $namePrefix, $type, $currentDir);

                if (!empty($name) && $imported instanceof RestRouteCollection) {
                    $parents[] = (!empty($prefix) ? $prefix . '/' : '') . $imported->getSingularName();
                    $prefix = null;

                    $this->collectionParents[$name] = $parents;
                }

                if (!empty($host)) {
                    $imported->setHost($host);
                }

                $imported->addPrefix((string) $prefix);
                $collection->addCollection($imported);

                break;
            default:
                throw new \InvalidArgumentException(sprintf('Unable to parse tag "%s"', $node->tagName));
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function parseRoute(RouteCollection $collection, \DOMElement $node, $path): void
    {
        if ($this->includeFormat) {
            $path = $node->getAttribute('path');
            // append format placeholder if not present
            if (false === strpos($path, '{_format}')) {
                $node->setAttribute('path', $path . '.{_format}');
            }

            // set format requirement if configured globally
            $requirements = $node->getElementsByTagNameNS(self::NAMESPACE_URI, 'requirement');
            $format = null;
            for ($i = 0; $i < $requirements->length; ++$i) {
                $item = $requirements->item($i);
                if ($item instanceof \DOMElement && $item->hasAttribute('_format')) {
                    $format = $item->getAttribute('_format');

                    break;
                }
            }

            if (null === $format && !empty($this->formats)) {
                $requirement = $node->ownerDocument->createElementNs(
                    self::NAMESPACE_URI,
                    'requirement',
                    implode('|', array_keys($this->formats))
                );
                $requirement->setAttribute('key', '_format');
                $node->appendChild($requirement);
            }
        }

        // set the default format if configured
        if (null !== $this->defaultFormat) {
            $defaultFormatNode = $node->ownerDocument->createElementNS(
                self::NAMESPACE_URI,
                'default',
                $this->defaultFormat
            );
            $defaultFormatNode->setAttribute('key', '_format');
            $node->appendChild($defaultFormatNode);
        }

        $options = $this->getOptions($node);

        foreach ($options as $option) {
            $node->appendChild($option);
        }

        $length = $node->childNodes->length;
        for ($i = 0; $i < $length; ++$i) {
            $loopNode = $node->childNodes->item($i);
            if (XML_TEXT_NODE === $loopNode->nodeType) {
                continue;
            }

            $newNode = $node->ownerDocument->createElementNS(
                self::NAMESPACE_URI,
                $loopNode->nodeName,
                $loopNode->nodeValue
            );

            foreach ($loopNode->attributes as $value) {
                $newNode->setAttribute($value->name, $value->value);
            }

            $node->appendChild($newNode);
        }

        parent::parseRoute($collection, $node, $path);
    }

    private function getOptions(\DOMElement $node): array
    {
        $options = [];
        foreach ($node->childNodes as $child) {
            if ($child instanceof \DOMElement && 'option' === $child->tagName) {
                $option = $node->ownerDocument->createElementNs(
                    self::NAMESPACE_URI,
                    'option',
                    $child->nodeValue
                );
                $option->setAttribute('key', $child->getAttribute('key'));
                $options[] = $option;
            }
        }

        return $options;
    }

    /**
     * {@inheritdoc}
     */
    public function supports($resource, $type = null): bool
    {
        return \is_string($resource) &&
            'xml' === pathinfo($resource, PATHINFO_EXTENSION) &&
            'rest' === $type;
    }

    protected function validate(\DOMDocument $dom): void
    {
        $restRoutinglocation = realpath(__DIR__ . '/../../Resources/config/schema/routing/rest_routing-1.0.xsd');
        $restRoutinglocation = rawurlencode(str_replace('\\', '/', $restRoutinglocation));
        $routinglocation = realpath(__DIR__ . '/../../Resources/config/schema/routing-1.0.xsd');
        $routinglocation = rawurlencode(str_replace('\\', '/', $routinglocation));
        $source = <<<EOF
<?xml version="1.0" encoding="utf-8" ?>
<xsd:schema xmlns="http://symfony.com/schema"
    xmlns:xsd="http://www.w3.org/2001/XMLSchema"
    targetNamespace="http://symfony.com/schema"
    elementFormDefault="qualified">

    <xsd:import namespace="http://www.w3.org/XML/1998/namespace" />
    <xsd:import namespace="http://friendsofsymfony.github.com/schema/rest" schemaLocation="$restRoutinglocation" />
    <xsd:import namespace="http://symfony.com/schema/routing" schemaLocation="$routinglocation" />
</xsd:schema>
EOF;

        $current = libxml_use_internal_errors(true);
        libxml_clear_errors();

        if (!$dom->schemaValidateSource($source)) {
            throw new \InvalidArgumentException(implode("\n", $this->getXmlErrors_($current)));
        }
        libxml_use_internal_errors($current);
    }

    /**
     * {@inheritdoc}
     *
     * @internal
     */
    protected function loadFile($file): \DOMDocument
    {
        $dom = XmlUtils::loadFile($file);
        $this->validate($dom);

        return $dom;
    }

    /**
     * Retrieves libxml errors and clears them.
     *
     * Note: The underscore postfix on the method name is to ensure compatibility with versions
     *       before 2.0.16 while working around a bug in PHP https://bugs.php.net/bug.php?id=62956
     */
    private function getXmlErrors_(bool $internalErrors): array
    {
        $errors = [];
        foreach (libxml_get_errors() as $error) {
            $errors[] = sprintf(
                '[%s %s] %s (in %s - line %d, column %d)',
                LIBXML_ERR_WARNING === $error->level ? 'WARNING' : 'ERROR',
                $error->code,
                trim($error->message),
                $error->file ? $error->file : 'n/a',
                $error->line,
                $error->column
            );
        }

        libxml_clear_errors();
        libxml_use_internal_errors($internalErrors);

        return $errors;
    }
}
