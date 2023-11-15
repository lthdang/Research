<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
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
        return [
            'current_password'=>'required',
            'new_password' => 'required|min:8|max:16|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])(?=.*[0-9]).+$/',
            'new_password_confirmation' => 'required|same:new_password'
        ];
    }
    public function messages()
    {
        return [
            'current_password.required'=>'Vui lòng nhập mật khẩu hiện tại',
            'new_password.required' => 'Vui lòng nhập mật khẩu.',
            'new_password.min' => 'Mật khẩu phải có ít nhất 8 ký',
            'new_password.max' => 'Mật Khẩu tối đa 16 ký tự',
            'new_password.regex'=>'Mật khẩu phải bao gồm chữ thường, IN HOA và ký tự đặc biệt và số',
            'new_password_confirmation.required'=> 'Vui lòng xác nhận mật khẩu.',
            'new_password_confirmation.same'=>'Xác nhận mật khẩu không đúng'
        ];
    }
}
