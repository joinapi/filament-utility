<?php

namespace Joinapi\FilamentUtility\Rules;

use Illuminate\Contracts\Validation\Rule;

class Telefone implements Rule
{

    /**
     * Valida o formato do telefone
     *
     * @param string $attribute
     * @param string $value
     * @return boolean
    */
    public function passes($attribute, $value)
    {
        return preg_match('/^\d{4}-\d{4}$/', $value) > 0;
    }


    public function message()
    {
    	return 'O campo :attribute não é um telefone válido.';
    }
}
