<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class DigitsValidator extends AbstractValidator
{
    protected string $message = ':field должно содержать только 4 цифры';

    public function rule(): bool
    {
        if (!empty($this->value) && preg_match('/^\d{4}$/', $this->value)) {
            // Check if the year is within the valid range (e.g. 1900-2099)
            $year = (int) $this->value;
            if ($year >= 1200 && $year <= date('Y')) {
                return true;
            }
        }

        // If the validation fails, set the error message
        $this->error = str_replace(':value', $this->value, $this->message);
        return false;
    }
}