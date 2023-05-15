<?php

namespace Http\Forms;

use Core\ValidationException;
use Core\Validator;

class LoginForm
{
    protected $errors = [];

    public function __construct(public array $attributes)
    {
        if (!Validator::string($attributes['username'], 4, 10)) {
            $this->errors['username'] = 'Please enter a username between 4 and 10 characters';
        }

        if (!Validator::string($attributes['password'], 8, 50)) {
            $this->errors['password'] = 'Please enter a password between 8 and 50 characters';
        }
    }

    public static function validate($attributes)
    {
        $form = new static($attributes);

        return $form->hasErrors() ? $form->throw() : $form;
    }

    public function throw()
    {
        ValidationException::throw($this->errors, $this->attributes);
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
