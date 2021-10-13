<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AtividadeParalelaRequest extends FormRequest
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
            'id_sala_sal' => 'required',
            'titulo_atp' => 'required',
            'autores_atp' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'id_sala_sal.required' => 'Campo <strong>Local/Sala</strong> é obrigatório',
            'titulo_atp.required' => 'Campo <strong>Título</strong> é obrigatório',
            'autores_atp.required' => 'Campo <strong>Autores</strong> é obrigatório'
        ];
    }
}