<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class StoreRegistroRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'type' => ['required', 'string', Rule::in(['denuncia', 'sugestao', 'duvida'])],
            'message' => ['required', 'string'],
            'is_identified' => ['required', 'boolean'],
            'whistleblower_name' => ['nullable', 'string'],
            'whistleblower_birth' => ['nullable', 'date_format:Y-m-d'],
            'deleted' => ['required', 'boolean']
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(['created_at' => Carbon::now()->format('Y-m-d H:i:s')]);
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
