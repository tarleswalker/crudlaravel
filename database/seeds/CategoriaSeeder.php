<?php

use Illuminate\Database\Seeder;
use App\Models\ModelCategoria;

class CategoriaSeeder extends Seeder
{
    /**
     * Popular o banco de dados com categorias.
     *
     * @return void
     */
    public function run(ModelCategoria $Categoria)
    {
        $Categoria->create([
        	'descricao' => 'Admin'
        ]);

        $Categoria->create([
        	'descricao' => 'Gerente'
        ]);

        $Categoria->create([
        	'descricao' => 'Normal'
        ]);
    }
}
