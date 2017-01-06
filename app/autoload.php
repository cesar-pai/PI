<?php

    use Doctrine\Common\Annotations\AnnotationRegistry;

    $loader = include __DIR__.'/../vendor/autoload.php';

    // intl
    if (!function_exists('intl_get_error_code')) {
        require_once __DIR__.'/../vendor/symfony/symfony/src/Symfony/Component/Locale/Resources/stubs/functions.php';

        $loader->add('', __DIR__.'/../vendor/symfony/symfony/src/Symfony/Component/Locale/Resources/stubs');
    }

    $loader->add('', __DIR__.'/../app/bootstrap.php.cache');
    $loader->add('', __DIR__.'/../app/AppKernel.php');

    AnnotationRegistry::registerLoader(array($loader, 'loadClass'));

    return $loader;