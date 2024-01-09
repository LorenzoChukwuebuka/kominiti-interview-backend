<?php

namespace App\Exceptions;

use Illuminate\Validation\ValidationException;

class CustomValidationException extends ValidationException
{
    public function render($request)
    {
        return response()->json([
            'error' => 'Validation failed',
            'messages' => $this->validator->errors()->all(),
        ], 422);
    }
}
