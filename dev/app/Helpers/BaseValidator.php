<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class BaseValidator
{
    /**
     * @throws ValidationException
     */
    public static function validate(array $data, array $rules): void
    {
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}

