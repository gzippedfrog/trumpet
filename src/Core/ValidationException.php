<?php

namespace Core;

class ValidationException extends \Exception
{
    /**
     * @var array
     */
    public readonly array $errors;
    /**
     * @var array
     */
    public readonly array $old;

    /**
     * @param array $errors
     * @param mixed $old
     * @return never
     * @throws ValidationException
     */
    public static function throw(array $errors, mixed $old): never
    {
        $e = new static;

        $e->errors = $errors;
        $e->old = $old;

        throw $e;
    }
}
