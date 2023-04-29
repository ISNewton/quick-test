<?php

namespace App\Rules;

use App\Models\User;
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
        $domain =  Str::afterLast($value, '@');

        if ($domain == 'gmail.com') {
            $fail('Gmail emails are forbidden , please use another email provider.');
        }

        $is_domain_exists = User::where('domain', $domain)->exists();

        if ($is_domain_exists) {
            $fail('The email domain already exists in our records , please use another.');
        }
    }
}
