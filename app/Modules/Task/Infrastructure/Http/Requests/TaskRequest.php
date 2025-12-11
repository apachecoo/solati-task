<?php

namespace App\Modules\Task\Infrastructure\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class TaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable','string'],
            'status' => ['nullable','in:pending,completed']
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'message'=>'Validation failed.',
                'errors' => $validator->errors(),
            ],422)
        );
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'title' => $this->sanitizeText($this->input('title')),
            'description' => $this->sanitizeText($this->input('description'))
        ]);
    }

    protected function sanitizeText(?string $text): ?string
    {
        if(!$text)
        {
            return $text;
        }

        return trim(strip_tags($text));
    }


}
