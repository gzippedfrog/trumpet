<?php

namespace Http\Forms;

use Core\Validator;

class PostForm extends Form
{
    public function __construct(public array $attributes)
    {
        if (!Validator::string($attributes['text'], 10, 255)) {
            $this->errors['text'] = 'Post length must be between 10 and 255 characters';
        }
    }
}