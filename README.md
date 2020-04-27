FOSRoutingRestBundle
====================

This bundle provides the automatic route generation for the FOSRestBundle 3.0.

Documentation
-------------

[Read the Documentation](Resources/doc)

Installation
------------

All the installation instructions are located in the [documentation](Resources/doc/1-setting_up_the_bundle.rst).

Switching from FOSRestBundle
-----------------------------

If you did before using the FOSRestBundle which removed the auto route generation the switch is easy:

```diff
// Replace ClassResourceInterface
-use FOS\RestBundle\Routing\ClassResourceInterface;
+use FOS\RestRoutingBundle\Routing\ClassResourceInterface;

// Replace RouteResource
-use FOS\RestBundle\Controller\Annotations\RouteResource;
+use FOS\RestRoutingBundle\Controller\Annotations\RouteResource;
```

License
-------

This bundle is under the MIT license. See the complete license [in the bundle](LICENSE).
