<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParticipanteRequest extends FormRequest
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
            'email' => 'required',
            'name'  => 'required',
            'password'  => 'required',
            'password_confirm'  => 'required|same:password'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email obrigatório',
            'name.required' => 'Nome obrigatório',
            'password.required' => 'Senha obrigaória',
            'password_confirm.required' => 'Confirmação de senha obrigatória',
            'password_confirm.same' => 'As senhas devem ser iguais'
        ];
    }
}
