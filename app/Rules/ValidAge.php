<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidAge implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Calculate the age based on the provided value (assuming $value is a date string).
        $birthdate = \DateTime::createFromFormat('Y-m-d', $value);
        $today = new \DateTime();
        $age = $today->diff($birthdate)->y;

        // Check if the age is exactly 60 years.
        return $age >= 60;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be exactly or greater than 60 years.';
    }
}
