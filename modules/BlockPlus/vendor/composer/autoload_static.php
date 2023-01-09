<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5c14c483f045c64cccfb52970bdd78e0
{
    public static $prefixLengthsPsr4 = array (
        'O' => 
        array (
            'OomphInc\\ComposerInstallersExtender\\' => 36,
        ),
        'C' => 
        array (
            'Composer\\Installers\\' => 20,
        ),
        'B' => 
        array (
            'BlockPlus\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'OomphInc\\ComposerInstallersExtender\\' => 
        array (
            0 => __DIR__ . '/..' . '/oomphinc/composer-installers-extender/src',
        ),
        'Composer\\Installers\\' => 
        array (
            0 => __DIR__ . '/..' . '/composer/installers/src/Composer/Installers',
        ),
        'BlockPlus\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit5c14c483f045c64cccfb52970bdd78e0::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5c14c483f045c64cccfb52970bdd78e0::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
