<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitcc28aead9dc1ef76de3183d2f3f4ec89
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInitcc28aead9dc1ef76de3183d2f3f4ec89', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitcc28aead9dc1ef76de3183d2f3f4ec89', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitcc28aead9dc1ef76de3183d2f3f4ec89::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
