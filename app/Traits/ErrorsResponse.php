<?php

namespace App\Traits;


use Illuminate\Http\JsonResponse;

trait ErrorsResponse
{
    public function errorsResponse($validator)
    {
        foreach ($validator->errors()->toArray() as $field => $messages) {
            $errors[$field] = $messages[0];
        }
        return $errors;
    }
}
