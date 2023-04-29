<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Str;

class ValidEmail implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $a = 'as@gmail.com';
        $b =  Str::afterLast($a, '@');

        dd($b);

        // dd($attribute , $value);
        // regex('/(.*)\.gmail\.com$/i');
    }
}
