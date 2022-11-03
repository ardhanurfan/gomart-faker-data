<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit43809a13cd590d4fc55754cefcd00250
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Faker\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Faker\\' => 
        array (
            0 => __DIR__ . '/..' . '/fzaninotto/faker/src/Faker',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit43809a13cd590d4fc55754cefcd00250::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit43809a13cd590d4fc55754cefcd00250::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit43809a13cd590d4fc55754cefcd00250::$classMap;

        }, null, ClassLoader::class);
    }
}
