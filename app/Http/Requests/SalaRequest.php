<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalaRequest extends FormRequest
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
            'nm_sala_sal' => 'required',
            'id_tipo_sala_tis' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nm_sala_sal.required' => 'Campo <strong>nome</strong> é obrigatório',
            'id_tipo_sala_tis.required' => 'Campo <strong>Tipo de Sala</strong> é obrigatório'
        ];
    }
}
