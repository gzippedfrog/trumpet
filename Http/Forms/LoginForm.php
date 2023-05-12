<?php

namespace Http\Forms;

use Core\Validator;

class LoginForm
{
    protected $errors = [];

    public function validate($username, $password)
    {
        if (!Validator::string($username, 4, 10)) {
            $this->errors['username'] = 'Please enter a username between 4 and 10 characters';
        }

        if (!Validator::string($password, 8, 50)) {
            $this->errors['password'] = 'Please enter a password between 8 and 50 characters';
        }

        return empty($this->errors);
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
