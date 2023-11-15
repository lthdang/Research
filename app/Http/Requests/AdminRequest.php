<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
class AdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
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
        $user = auth()->user();
        if (!$user) {
            return redirect()->back()->with('error', 'User authentication failed.');
        }
        return [
            'user_name'=>'required|max:255',
            'full_name'=>'required|max:50',
            'email'=>'required|email:rfc,dns|unique:users,email,' . $user->id,
            'phone'=>'required|max:12|regex:/^0[0-9]{9,12}$/',
            'address'=>'required| max:255',
            'brith_day'=>['required', 'date', 'before_or_equal:today', 'before_or_equal:' . now()->subYears(18)->format('Y-m-d')],

        ];

        if (!empty($this->file('avatar'))) {
            $rules['avatar'] = 'image|mimes:jpeg,png,jpg,gif|max:2048';
        }

        return $rules;
    }
    public function messages(){
        return[
            'user_name.required'=>'The user name field is required.',
            'full_name.max'=>'The full name may not be greater than :max characters.',
            'email.required'=>'The email field is required',
            'email.email'=>'Email address is not valid.',
            'email.unique'=>'This email address is already in use.',
            'phone'=>[
                'required'=>'This phone field is required.',
                'regex'=> 'The number phone is not valid',
            ],
            'avatar.image'=>'The image must be an image file.',
            'avatar.mimes'=>'The image must be a file of type: :values.',
            'brith_day'=>[
                'required'=>'The birth date field is required.',
                'date'=>'The birth date field must be a valid date.',
                'before_or_equal'=>'The birth date must be before or equal to today.',
                'before_or_equal'=>'The birth date must be at least 18 years ago.',
            ],
        ];

    }
}
