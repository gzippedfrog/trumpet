<?php

namespace Http\Forms;

use Core\ValidationException;

abstract class Form
{
    protected $errors = [];
    public array $attributes = [];

    abstract public function __construct(array $attributes);

    public static function validate($attributes)
    {
        $form = new static($attributes);

        return $form->hasErrors() ? $form->throw() : $form;
    }

    public function throw ()
    {
        ValidationException::throw ($this->errors, $this->attributes);
    }

    public function hasErrors()
    {
        return (bool) count($this->errors);
    }


    public function getErrors()
    {
        return $this->errors;
    }

    public function setError($name, $description)
    {
        $this->errors[$name] = $description;

        return $this;
    }
}