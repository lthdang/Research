<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'email' => 'required|email:rfc,dns|unique:users,email',
            'username' => 'required|unique:users,username',
            'password' => 'required|min:8|max:16|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).+$/',
            'password_confirmation' => 'required|same:password'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'email.email' => 'Địa chỉ email không hợp lệ.',
            'email.unique' => 'Địa chỉ email này đã được sử dụng.',
            'username.required' => 'Vui lòng nhập tên người dùng.',
            'username.unique' => 'Tên người dùng này đã tồn tại.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký',
            'password.max' => 'Mật Khẩu tối đa 16 ký tự',
            'password.regex'=>'Mật khẩu phải bao gồm chữ thường, IN HOA và ký tự đặc biệt'
        ];
    }


}
