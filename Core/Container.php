<?php

namespace Core;

class Container
{
    protected $resolvers = [];

    public function bind($key, $resolver)
    {
        $this->resolvers[$key] = $resolver;
    }

    public function resolve($key)
    {
        if (!array_key_exists($key, $this->resolvers)) {
            throw new \Exception("Failed to find resolver with key: $key");
        }

        return call_user_func($this->resolvers[$key]);
    }
}
