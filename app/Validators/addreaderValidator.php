<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class addreaderValidator extends AbstractValidator
{

    protected string $message = 'Field :field is required';

    public function rule(): bool
    {
        return !preg_match('/\d/', $this->value);
    }
    protected array $rules = [
        'FIO' => ['required', 'alpha'],
        'email' => ['required'],
    ];
}
