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
            'username' => 'required|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:3',
            'repassword' => 'same:password',
        ];
    }

    public function messages(){
        return [
            'username.required' => ' Bạn chưa nhập tên tài khoản.',
            'username.unique' => 'Tài khoản này đã tồn tại.',
            'email.required' => 'Bạn chưa nhập email.',
            'email.unique' => 'Email này đã tồn tại',
            'password.required' => 'Bạn chưa nhập mật khẩu',
            'password.min' => 'Độ dài mật khẩu chưa an toàn',
            'repassword.same' => 'Xác nhận sai mật khẩu',
        ];
    }
}
