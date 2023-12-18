<?php

namespace App\Http\Requests;

use App\Rules\CurrencyFieldRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class ConvertRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Failed api custom response
     * @param Validator $validator
     * @return object
     */
    public $validator = null;

    protected function failedValidation(Validator $validator): object
    {
        return $this->validator = $validator;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'from' => ['required', new CurrencyFieldRule],
            'to' => ['required', new CurrencyFieldRule],
            'amount' => ['required', 'numeric','max:999999'],
        ];
    }
}
