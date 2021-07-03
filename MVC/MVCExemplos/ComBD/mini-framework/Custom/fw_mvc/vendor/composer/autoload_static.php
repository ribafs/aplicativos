<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita6be44efc8efdc3a7367a4e416fb10d8
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Mvc\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Mvc\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita6be44efc8efdc3a7367a4e416fb10d8::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita6be44efc8efdc3a7367a4e416fb10d8::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
