<?php

namespace App\Http\Requests\Auth;

use App\ConverterModels\Gender;
use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends BaseRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'gender' => ['required', Rule::in(array_values(Gender::$text))],
            'phone_number' => 'required',
            'address' => 'string|max:1024',
            'image' => 'image',
            'nationality_id' => ['required', 'exists:nationalities,id'],
            'type_id' => ['required', 'exists:user_types,id'],
            'sub_type_id' => ['nullable', 'exists:user_sub_types,id'],
            'theme_id' => ['nullable', 'exists:themes,id'],
            // Seller Fields
            'shop_name' => 'required_if:type_id,3',
            'shop_address' => 'required_if:type_id,3',
            // Student Fields
            'university' => Rule::requiredIf(function () {
                return $this->input('type_id') == 2 && $this->input('sub_type_id') == 1;
            }),
            'student_number' => Rule::requiredIf(function () {
                return $this->input('type_id') == 2 && $this->input('sub_type_id') == 1;
            }),
        ];
    }
}
