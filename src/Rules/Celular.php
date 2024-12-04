<?php

namespace Joinapi\FilamentUtility\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\ValidatorAwareRule;
use Illuminate\Validation\Validator;

class Celular implements ValidationRule , ValidatorAwareRule
{
    /**
     * The validator instance.
     *
     * @var \Illuminate\Validation\Validator
     */
    protected $validator;

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if( preg_match('/^\d{4,5}-\d{4}$/', $value)  <= 0 ){
            $fail('O :attribute já existe em nossos registros.');
        }
    }

    public function setValidator(Validator $validator): static
    {
        $this->validator = $validator;

        return $this;
    }
}
