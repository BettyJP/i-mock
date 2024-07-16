<?php

namespace App\Http\Request\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class Generate extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation()
    {
        $this->merge([
            'Content-Type' => $this->headers->get('Content-Type'),
            'Accept' => $this->headers->get('Accept'),
            'Authorization' => $this->headers->get('Authorization'),
        ]);
    }

    public function rules()
    {
        return [
            'Content-Type' => 'required|in:application/x-www-form-urlencoded',
            'Accept' => 'required|in:application/json',
            'grant_type' => 'required|in:authorization_code',
            'client_id' => 'required_without:Authorization',
            'client_secret' => 'required_without:Authorization',
            'Authorization' => [
            'required_without:client_id,client_secret',
            function ($attribute, $value, $fail) {
                if ($value && !preg_match('/^Basic ([a-zA-Z0-9]+)$/', $value)) {
                    $fail("The $attribute format is invalid.");
                }
            },
        ],
        ];
    }

    public function failedValidation(Validator $varidator)
    {
        $response = response()->json([
            'error_description' => $varidator->errors(),
            'error' => 'invalid_request',
            // 'headers' => $this->headers->all(),
            // 'contents' => $this->getContent(),
        ], 200);

        throw new HttpResponseException($response);
    }
}
