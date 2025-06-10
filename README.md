# RestRoutingBundle ⛰

[![GitHub license](https://img.shields.io/github/license/handcraftedinthealps/RestRoutingBundle.svg)](https://github.com/handcraftedinthealps/RestRoutingBundle/blob/master/LICENSE)
[![GitHub tag (latest SemVer)](https://img.shields.io/github/tag/handcraftedinthealps/RestRoutingBundle.svg)](https://github.com/handcraftedinthealps/RestRoutingBundle/releases)
[![Github Test workflow status](https://img.shields.io/github/workflow/status/handcraftedinthealps/RestRoutingBundle/Test%20application/master.svg?label=test-workflow)](https://github.com/handcraftedinthealps/RestRoutingBundle/actions)

This bundle provides the automatic route generation for the FOSRestBundle 3.0.

## Documentation

[Read the Documentation](Resources/doc)

## Installation

All the installation instructions are located in the [documentation](Resources/doc/1-setting_up_the_bundle.rst).

## Opt-out of the `type: rest` routing

You might want to migrate away from this bundle and use normal Symfony routes.
Via the command inside this bundle you can convert all `type: rest` routes to normal Symfony routes:

```bash
bin/console fos:rest:routing:dump-symfony-routes

# filter by a specific controller
bin/console fos:rest:routing:dump-symfony-routes --controller="your.controller.service"

# filter by a specific name prefix
bin/console fos:rest:routing:dump-symfony-routes --name-prefix="your_prefix."
```

Copy the result into a `routing.yaml` file of your choice.

## Switching from FOSRestBundle

If you did before using the FOSRestBundle which removed the auto route generation the switch is easy.
After you did successfully install the bundle change the configuration to the new bundle:

**before**

```yaml
fos_rest:
    routing_loader:
        default_format: 'json'
        prefix_methods: true
        include_format: true
```

**after**

```yaml
handcraftedinthealps_rest_routing:
    routing_loader:
        default_format: 'json'
        prefix_methods: true
        include_format: true
        # optional set supported formats else the configured one from fos_rest are used if installed:
        # formats:
        #     json: true
        #     xml: true
```

Update the classes (not necessary but recommended):

```diff
// Replace ClassResourceInterface
-use FOS\RestBundle\Routing\ClassResourceInterface;
+use HandcraftedInTheAlps\RestRoutingBundle\Routing\ClassResourceInterface;

// Replace RouteResource
-use FOS\RestBundle\Controller\Annotations\RouteResource;
+use HandcraftedInTheAlps\RestRoutingBundle\Controller\Annotations\RouteResource;

// Replace NamePrefix
-use FOS\RestBundle\Controller\Annotations\NamePrefix;
+use HandcraftedInTheAlps\RestRoutingBundle\Controller\Annotations\NamePrefix;

// Replace Prefix
-use FOS\RestBundle\Controller\Annotations\Prefix;
+use HandcraftedInTheAlps\RestRoutingBundle\Controller\Annotations\Prefix;

// Replace NoRoute
-use FOS\RestBundle\Controller\Annotations\NoRoute;
+use HandcraftedInTheAlps\RestRoutingBundle\Controller\Annotations\NoRoute;

// Replace Version
-use FOS\RestBundle\Controller\Annotations\Version;
+use HandcraftedInTheAlps\RestRoutingBundle\Controller\Annotations\Version;
```

License
-------

This bundle is under the MIT license. See the complete license [in the bundle](LICENSE).
