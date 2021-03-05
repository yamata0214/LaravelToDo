<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistRequest extends FormRequest{

    public function authorize(){
        if($this->path() == 'add'){
            return true;
        } else {
            return false;
        }
    }
    public function rules(){
        return [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required',
        ];
    }
    public function messages(){
       return [
           'name.required'  => '名前を入れて下さい。',
           'name.max'  => '名前は255文字以内で入れてください。',
           'email.required'  => 'メールアドレスを入れて下さい。',
           'email.email'  => 'メールアドレスを正しく入力して下さい。',
           'email.max'  => 'メールアドレスを255文字以内で入れてください。',
           'password.required'  => 'パスワードを入れて下さい。',
       ];
    }
}
