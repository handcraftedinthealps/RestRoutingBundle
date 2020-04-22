Step 1: Setting up the bundle
=============================

A) Download the Bundle
----------------------

Assuming you already have `set up a Symfony project`_, you can add the FOSRoutingRestBundle to it. Open a command console,
enter your project directory and execute the following command to download the latest stable version of this bundle:

.. code-block:: bash

    $ composer require friendsofsymfony/rest-routing-bundle

This command requires you to have Composer installed globally, as explained
in the `installation chapter`_ of the Composer documentation.

.. caution::

    If you are not using Flex, you also have to enable the bundle by adding the following line in the ``config/bundles.php``::

        // config/bundles.php

        FOS\RestRoutingBundle\FOSRoutingRestBundle::class => ['all' => true],
