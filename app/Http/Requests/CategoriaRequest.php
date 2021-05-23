<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriaRequest extends FormRequest
{
    /**
     * Determina se o usuário está autorizado a fazer esta solicitação.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Obtem as regras de validação que se aplicam à solicitação.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'descricao'=>'required|min:3',
        ];
    }

    /**
     * Obtem as mensagens que aplicam validação à solicitação.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'descricao.required' => 'Informe a descrição!',
            'descricao.min' => 'A descrição deve ter pelo menos 3 caracteres.',
        ];
    }
}
