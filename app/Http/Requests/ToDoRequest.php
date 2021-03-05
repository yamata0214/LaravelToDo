<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ToDoRequest extends FormRequest{

    public function authorize(){
        if($this->path() == 'task'){
            return true;
        } else {
            return false;
        }
    }
    public function rules(){
        return [
            'mailaddress' => 'email',
        ];
    }
    public function messages(){
       return [
           'mailaddress.email'  => 'メールアドレスを正しく入れて下さい。',
       ];
    }
}
