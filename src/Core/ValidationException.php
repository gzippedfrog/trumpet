<?php

namespace Core;

class ValidationException extends \Exception
{
    public readonly array $errors;
    public readonly array $old;

    public static function throw(array $errors, mixed $old): never
    {
        $e = new static;

        $e->errors = $errors;
        $e->old = $old;

        throw $e;
    }
}
