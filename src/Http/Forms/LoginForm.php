<?php

namespace Http\Forms;

use Core\Validator;

class LoginForm extends Form
{
    public function __construct(public array $attributes)
    {
        if (!Validator::string($attributes['username'], 4, 10)) {
            $this->errors['username'] = 'Please enter a username between 4 and 10 characters';
        }

        if (!Validator::string($attributes['password'], 8, 50)) {
            $this->errors['password'] = 'Please enter a password between 8 and 50 characters';
        }
    }
}