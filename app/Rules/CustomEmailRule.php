<?php

namespace App\Rules;

use Illuminate\Validation\Rule;

class CustomEmailRule implements Rule
{
    public function passes($attribute, $value)
    {
        // Check if the email contains the "@student.gmi.edu.my" domain
        return strpos($value, '@student.gmi.edu.my') !== false;
    }

    public function message()
    {
        return 'The :attribute must be a valid email with @student.gmi.edu.my domain.';
    }
}
