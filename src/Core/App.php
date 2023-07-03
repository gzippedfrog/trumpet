<?php

namespace Core;

class App
{
    /**
     * @var Container
     */
    private static Container $container;

    /**
     * @param Container $container
     * @return void
     */
    public static function setContainer(Container $container): void
    {
        static::$container = $container;
    }

    /**
     * @return Container
     */
    public static function getContainer(): Container
    {
        return static::$container;
    }

    /**
     * @param string $className
     * @param callable $resolver
     * @return void
     */
    public static function bind(string $className, callable $resolver): void
    {
        static::getContainer()->bind($className, $resolver);
    }

    /**
     * @template T
     * @param class-string<T> $className
     * @return T
     * @throws \Exception
     */
    public static function resolve(string $className)
    {
        return static::getContainer()->resolve($className);
    }
}
