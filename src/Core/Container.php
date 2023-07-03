<?php

namespace Core;

class Container
{
    /**
     * @var callable[]
     */
    protected array $resolvers = [];

    public function bind(string $key, callable $resolver): void
    {
        $this->resolvers[$key] = $resolver;
    }

    /**
     * @template T
     * @param class-string<T> $key
     * @return T
     * @throws \Exception
     */
    public function resolve(string $key)
    {
        if (!array_key_exists($key, $this->resolvers)) {
            throw new \Exception("Failed to find resolver with key: $key");
        }

        return call_user_func($this->resolvers[$key]);
    }
}
