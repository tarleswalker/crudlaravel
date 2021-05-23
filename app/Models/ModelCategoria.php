<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelCategoria extends Model
{
    protected $table='categoria';
    protected $fillable=['descricao'];
     
     /**
     * Relação de categoria com pessoa.
     *
     */
    public function relPessoas()
    {
    	return $this->hasMany('App\Models\ModelPessoa', 'id_categoria');
    }
}
