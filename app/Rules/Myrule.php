<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Myrule implements Rule{
    public function __construct($n)
    {
        //
    }

    public function passes($attribute, $value)
    {
        //
    }

    public function message()
    {
        return 'The validation error message.';
    }
}
