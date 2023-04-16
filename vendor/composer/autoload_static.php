<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit964b1307ce3c233ca7de983842afc012
{
    public static $files = array (
        '253c157292f75eb38082b5acb06f3f01' => __DIR__ . '/..' . '/nikic/fast-route/src/functions.php',
        '7b11c4dc42b3b3023073cb14e519683c' => __DIR__ . '/..' . '/ralouphie/getallheaders/src/getallheaders.php',
        'a4a119a56e50fbb293281d9a48007e0e' => __DIR__ . '/..' . '/symfony/polyfill-php80/bootstrap.php',
    );

    public static $prefixLengthsPsr4 = array (
        'V' => 
        array (
            'VPHP\\' => 5,
        ),
        'T' => 
        array (
            'Tests\\' => 6,
        ),
        'S' => 
        array (
            'Symfony\\Polyfill\\Php80\\' => 23,
            'Slime\\' => 6,
            'Slim\\Psr7\\' => 10,
            'Slim\\' => 5,
        ),
        'R' => 
        array (
            'ReallySimpleJWT\\' => 16,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
            'Psr\\Http\\Server\\' => 16,
            'Psr\\Http\\Message\\' => 17,
            'Psr\\Container\\' => 14,
            'PsrJwt\\' => 7,
        ),
        'N' => 
        array (
            'Nyholm\\Psr7\\' => 12,
        ),
        'L' => 
        array (
            'LightnCandy\\' => 12,
        ),
        'H' => 
        array (
            'Http\\Message\\' => 13,
        ),
        'F' => 
        array (
            'Fig\\Http\\Message\\' => 17,
            'FastRoute\\' => 10,
        ),
        'D' => 
        array (
            'DW\\' => 3,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'VPHP\\' => 
        array (
            0 => __DIR__ . '/..' . '/hxgf/cookie/src',
            1 => __DIR__ . '/..' . '/hxgf/dbkit/src',
            2 => __DIR__ . '/..' . '/hxgf/http-request/src',
            3 => __DIR__ . '/..' . '/hxgf/x-utilities/src',
        ),
        'Tests\\' => 
        array (
            0 => __DIR__ . '/..' . '/rbdwllr/psr-jwt/tests',
        ),
        'Symfony\\Polyfill\\Php80\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-php80',
        ),
        'Slime\\' => 
        array (
            0 => __DIR__ . '/..' . '/hxgf/slime-render/src',
        ),
        'Slim\\Psr7\\' => 
        array (
            0 => __DIR__ . '/..' . '/slim/psr7/src',
        ),
        'Slim\\' => 
        array (
            0 => __DIR__ . '/..' . '/slim/slim/Slim',
        ),
        'ReallySimpleJWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/rbdwllr/reallysimplejwt/src',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/src',
        ),
        'Psr\\Http\\Server\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-server-handler/src',
            1 => __DIR__ . '/..' . '/psr/http-server-middleware/src',
        ),
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-factory/src',
            1 => __DIR__ . '/..' . '/psr/http-message/src',
        ),
        'Psr\\Container\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/container/src',
        ),
        'PsrJwt\\' => 
        array (
            0 => __DIR__ . '/..' . '/rbdwllr/psr-jwt/src',
        ),
        'Nyholm\\Psr7\\' => 
        array (
            0 => __DIR__ . '/..' . '/nyholm/psr7/src',
        ),
        'LightnCandy\\' => 
        array (
            0 => __DIR__ . '/..' . '/zordius/lightncandy/src',
        ),
        'Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/php-http/message-factory/src',
        ),
        'Fig\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/fig/http-message-util/src',
        ),
        'FastRoute\\' => 
        array (
            0 => __DIR__ . '/..' . '/nikic/fast-route/src',
        ),
        'DW\\' => 
        array (
            0 => __DIR__ . '/..' . '/hxgf/dw-utilities/src',
        ),
    );

    public static $classMap = array (
        'Attribute' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/Attribute.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'PhpToken' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/PhpToken.php',
        'Stringable' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/Stringable.php',
        'UnhandledMatchError' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/UnhandledMatchError.php',
        'ValueError' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/ValueError.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit964b1307ce3c233ca7de983842afc012::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit964b1307ce3c233ca7de983842afc012::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit964b1307ce3c233ca7de983842afc012::$classMap;

        }, null, ClassLoader::class);
    }
}
