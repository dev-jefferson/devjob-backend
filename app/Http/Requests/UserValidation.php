<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserValidation extends FormRequest
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

        switch($this->method()) {
            case 'POST':{
                return [
                    'name'                  => ['required', 'string', 'max:255'],
                    'email'                 => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'username'              => ['required', 'string', 'unique:users'],
                    'password'              => ['required', 'min:6', 'confirmed'],
                    'password_confirmation' => ['required', 'min:6'],
                    'contacts'              => 'required',
                    'addresses'             => 'required',
                    'linkedin'              => ['required', 'string'],
                    'git'                   => ['required', 'string'],
                ];
            }
            case 'PUT':{
                return [
                    'name'                  => ['required', 'string', 'max:255'],
                    'email'                 => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$this->user->id],
                    'username'              => ['required', 'string', 'unique:users,username,'.$this->user->id],
                    'password'              => ['required', 'min:6', 'confirmed'],
                    'password_confirmation' => ['required', 'min:6'],
                    'contacts'              => 'required',
                    'addresses'             => 'required',
                    'linkedin'              => ['required', 'string'],
                    'git'                   => ['required', 'string'],
                ];
            }
            default:break;
        }

    }

    public function messages()
    {
        return [
            'name.required' => 'Favor informar o nome do usuário.',
            'name.max' => 'O nome não pode ter mais que 255 caracteres.',
            'email.required' => 'Favor infomar o email de acesso.',
            'email.email' => 'Favor infomar um email válido.',
            'email.unique' => 'Este e-mail já se encontra registrado no sistema.',
            'username.unique' => 'O nome de usuário já foi escolhido.',
            'password_confirmation.confirmed' => 'As senhas não são correspondentes.',
            'string' => 'Favor digitar o campo da forma correta.',
        ];
    }
}
