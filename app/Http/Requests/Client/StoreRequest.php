<?php

declare(strict_types=1);

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        $this->checkPasswordConfirmation();

        return [
            "name" => "required|string|max:100",
            "address1" => "required|string",
            "address2" => "required|string",
            "city" => "required|string|max:100",
            "state" => "required|string|max:100",
            "country" => "required|string|max:100",
            "zipCode" => "required|string|max:20",
            "phoneNo1" => "required|string|max:20",
            "phoneNo2" => "string|max:20",
            "user" => "required|array",
            "user.firstName" => "required|string|max:50",
            "user.lastName" => "required|string|max:50",
            "user.email" => "required|email|max:150",
            "user.password" => "required|string|max:256",
            "user.phone" => "required|string|max:20",
        ];
    }

    public function checkPasswordConfirmation()
    {
        if (request()->get('user')['password'] !== request()->get('user')['passwordConfirmation']) {
            throw new HttpResponseException(response()->json([
                "message" => "The given data was invalid.",
                "errors" => [
                    "user.password" => [
                        "The user.password confirmation does not match."
                    ]
                ]
            ], 422));
        }
    }
}
