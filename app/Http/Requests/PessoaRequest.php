<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PessoaRequest extends FormRequest
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
            'nome'=>'required|min:5',
            'email'=>'required|email|min:5|unique:pessoa,email,'.$this->id,
            'categoria'=>'required|numeric'
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
            'nome.required' => 'Coloque o Nome!',
            'nome.min' => 'O nome deve ter pelo menos 5 caracteres.',
            'email.required' => 'Informe o E-mail!',
            'email.email' => 'Informe E-mail Válido!',
            'email.min' => 'O e-mail deve ter pelo menos 5 caracteres.',
            'email.unique' => 'E-mail já cadastrado!',
            'categoria.numeric'  => 'Selecione a Categoria!',
        ];
    }
}
