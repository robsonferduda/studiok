<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParticipanteIndividualRequest extends FormRequest
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
            'evento' => 'required|min:1',
            'tipo' => 'required',
            'situacao' => 'required',
            'ds_email_pes' => 'required',
            'nm_pessoa_pes' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'evento.required' => 'Campo <strong>Evento</strong> é obrigatório',
            'evento.min' => 'Campo <strong>Evento</strong> é obrigatório',
            'tipo.required' => 'Campo <strong>Tipo de Inscrição</strong> é obrigatório',
            'situacao.required' => 'Campo <strong>Situação</strong> é obrigatório',
            'ds_email_pes.required' => 'Campo <strong>Email</strong> é obrigatório',
            'nm_pessoa_pes.required' => 'Campo <strong>Nome</strong> é obrigatório'
        ];
    }
}