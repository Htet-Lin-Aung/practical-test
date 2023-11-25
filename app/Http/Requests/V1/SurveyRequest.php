<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class SurveyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $fields = $this->form->fields()->pluck('code');
        
        $validationRules = [];

        $validationRules['email'] = ['required', 'unique:users,email', 'email'];

        foreach ($fields as $field) {
            $validationRules[$field] = 'required'; 
        }

        return $validationRules;
    }

    public function messages(): array
    {
        return [
            'email.unique' => 'The survey has already been answered with this email.'
        ];
    }
}
