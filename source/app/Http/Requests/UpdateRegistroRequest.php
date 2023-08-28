<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRegistroRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'type' => ['nullable', 'string', Rule::in(['denuncia', 'sugestao', 'duvida'])],
            'message' => ['nullable', 'string'],
            'is_identified' => ['nullable', 'boolean'],
            'whistleblower_name' => ['nullable', 'string'],
            'whistleblower_birth' => ['nullable', 'date_format:Y-m-d'],
            'deleted' => ['nullable', 'boolean'],
            'id' => ['required', 'integer']
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(['id' => $this->route('id')]);
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
