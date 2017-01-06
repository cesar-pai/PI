Symfony Standard Edition
========================

Welcome to the Symfony Standard Edition - a fully-functional Symfony2
application that you can use as the skeleton for your new applications.

For details on how to download and get started with Symfony, see the
[Installation][1] chapter of the Symfony Documentation.

What's inside?
--------------

The Symfony Standard Edition is configured with the following defaults:

  * An AppBundle you can use to start coding;

  * Twig as the only configured template engine;

  * Doctrine ORM/DBAL;

  * Swiftmailer;

  * Annotations enabled for everything.

It comes pre-configured with the following bundles:

  * **FrameworkBundle** - The core Symfony framework bundle

  * [**SensioFrameworkExtraBundle**][6] - Adds several enhancements, including
    template and routing annotation capability

  * [**DoctrineBundle**][7] - Adds support for the Doctrine ORM

  * [**TwigBundle**][8] - Adds support for the Twig templating engine

  * [**SecurityBundle**][9] - Adds security by integrating Symfony's security
    component

  * [**SwiftmailerBundle**][10] - Adds support for Swiftmailer, a library for
    sending emails

  * [**MonologBundle**][11] - Adds support for Monolog, a logging library

  * [**AsseticBundle**][12] - Adds support for Assetic, an asset processing
    library

  * **WebProfilerBundle** (in dev/test env) - Adds profiling functionality and
    the web debug toolbar

  * **SensioDistributionBundle** (in dev/test env) - Adds functionality for
    configuring and working with Symfony distributions

  * [**SensioGeneratorBundle**][13] (in dev/test env) - Adds code generation
    capabilities

  * **DebugBundle** (in dev/test env) - Adds Debug and VarDumper component
    integration

All libraries and bundles included in the Symfony Standard Edition are
released under the MIT or BSD license.

Enjoy!

How to get set up ?
-------------------

In order to get this repository, type the commands in a terminal (in the folder of your choice):

$ git clone https://github.com/cesar-pai/PI.git

$ cd PI

Then get composer.phar and install the bundles :

$ php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"

$ php -r "if (hash_file('SHA384', 'composer-setup.php') === '61069fe8c6436a4468d0371454cf38a812e451a14ab1691543f25a9627b97ff96d8753d92a00654c21e2212a5ae1ff36') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"

$ php composer-setup.php

$ php -r "unlink('composer-setup.php');"

$ php composer.phar install

$ php composer.phar update

Then initialize the database :

$ php app/console doctrine:database:create

$ php app/console doctrine:generate:entities AssociationBundle

$ php app/console doctrine:generate:entities DemandeSubventionBundle

$ php app/console doctrine:generate:entities DocumentBundle

$ php app/console doctrine:generate:entities UserBundle

$ php app/console doctrine:schema:update --dump-sql

$ php app/console doctrine:schema:update --force

Make sure the database is OK :

$ php app/console doctrine:ensure-production-settings --env=prod

Finally, you can launch the server with the following command :

$ php app/console server:run

You can access the web site at the URL : localhost:8000.




[1]:  https://symfony.com/doc/2.7/book/installation.html
[6]:  https://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/index.html
[7]:  https://symfony.com/doc/2.7/book/doctrine.html
[8]:  https://symfony.com/doc/2.7/book/templating.html
[9]:  https://symfony.com/doc/2.7/book/security.html
[10]: https://symfony.com/doc/2.7/cookbook/email.html
[11]: https://symfony.com/doc/2.7/cookbook/logging/monolog.html
[12]: https://symfony.com/doc/2.7/cookbook/assetic/asset_management.html
[13]: https://symfony.com/doc/2.7/bundles/SensioGeneratorBundle/index.html
