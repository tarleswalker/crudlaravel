<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Popular o banco de dados com categorias e pessoas.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategoriaSeeder::class);
        $this->call(PessoaSeeder::class);
    }
}
