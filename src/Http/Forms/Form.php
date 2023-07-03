<?php

namespace Http\Forms;

use Core\ValidationException;

abstract class Form
{
    protected array $errors = [];
    public array $attributes = [];

    abstract public function __construct(array $attributes);

    /**
     * @throws ValidationException
     */
    public static function validate(array $attributes): static
    {
        $form = new static($attributes);

        $form->hasErrors() && $form->throw();

        return $form;
    }

    /**
     * @throws ValidationException
     */
    public function throw(): never
    {
        ValidationException::throw($this->errors, $this->attributes);
    }

    public function hasErrors(): bool
    {
        return (bool)count($this->errors);
    }


    public function getErrors(): array
    {
        return $this->errors;
    }

    public function setError(string $name, string $description): self
    {
        $this->errors[$name] = $description;

        return $this;
    }
}