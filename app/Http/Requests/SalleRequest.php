<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class SalleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [

            'nom' => "required|string|between:5,50",
            'adresse' => "required|string|between:5,100",
            'code_postal' => "required|string|between:2,5",
            'ville' => "required|string|between:5,50"
        ];
    }

    /**
     * @return string[]
     */
    #[ArrayShape(['required' => "string", 'between' => "string"])] public function messages(): array
    {
        return [
            'required' => 'Le champ :attribute est obligatoire.',
            'between' => 'Le champ :attribute doit contenir entre :min et :max caractères.',
        ];


}
}
