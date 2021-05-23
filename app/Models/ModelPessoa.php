<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelPessoa extends Model
{
    protected $table='pessoa';
    protected $fillable=['nome', 'email', 'id_categoria'];

     /**
     * Relação de pessoa com categoria.
     *
     */
    public function relCategoria()
    {
    	return $this->hasOne('App\Models\ModelCategoria', 'id', 'id_categoria');
    }


}
