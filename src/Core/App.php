<?php

namespace Core;

class App
{
    static Container $container;

    public static function setContainer(Container $container): void
    {
        static::$container = $container;
    }

    public static function container(): Container
    {
        return static::$container;
    }

    public static function bind(string $className, callable $resolver): void
    {
        static::container()->bind($className, $resolver);
    }

    /**
     * @template T
     * @param class-string<T> $className
     * @return T
     * @throws \Exception
     */
    public static function resolve(string $className)
    {
        return static::container()->resolve($className);
    }
}
