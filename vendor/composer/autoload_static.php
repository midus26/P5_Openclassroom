<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit50667256ca430cf16e57ba66f24ddd42
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/App',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit50667256ca430cf16e57ba66f24ddd42::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit50667256ca430cf16e57ba66f24ddd42::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit50667256ca430cf16e57ba66f24ddd42::$classMap;

        }, null, ClassLoader::class);
    }
}