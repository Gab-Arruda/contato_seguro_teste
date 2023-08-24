<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IndexRegistroRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'deleted' => ['nullable', 'boolean'],
            'type' => ['nullable', 'string', Rule::in(['denuncia', 'sugestao', 'duvida'])],
            'orderBy' => ['nullable', 'string', Rule::in(['type', 'message', 'whistleblower_name', 'whistleblower_birth', 'created_at'])],
            'is_identified' => ['nullable', 'boolean'],
            'page' => ['nullable', 'integer', 'gt:0', ' required_with:per_page'],
            'per_page' => ['nullable', 'integer', 'gt:0', 'required_with:page'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        $response = response()->json([
            'message' => 'Invalid data',
            'details' => $errors->messages(),
        ], 422);

        throw new HttpResponseException($response);
    }
}
