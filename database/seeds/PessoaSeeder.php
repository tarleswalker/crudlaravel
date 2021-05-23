<?php

use Illuminate\Database\Seeder;
use App\Models\ModelPessoa;
use App\Models\ModelCategoria;

class PessoaSeeder extends Seeder
{	
	private $ObjCategoria;

    /**
     * Popular o banco de dados com pessoas.
     *
     * @return void
     */
    public function run(ModelPessoa $Pessoa)
    {	
    	
    	$this->ObjCategoria = new ModelCategoria();

    	$id_admin   = $this->ObjCategoria->where(['descricao'=>'Admin'])->get('id')[0]['id'];
    	$id_gerente = $this->ObjCategoria->where(['descricao'=>'Gerente'])->get('id')[0]['id'];
    	$id_normal  = $this->ObjCategoria->where(['descricao'=>'Normal'])->get('id')[0]['id'];

        $Pessoa->create([
        	'nome' => 'Jorge da Silva',
            'email' => 'jorge@terra.com.br',
            'id_categoria' => $id_admin
        ]);
        $Pessoa->create([
        	'nome' => 'Flavia Monteiro',
            'email' => 'flavia@globo.com',
            'id_categoria' => $id_gerente
        ]);
        $Pessoa->create([
        	'nome' => 'Marcos Frota Ribeiro',
            'email' => 'ribeiro@gmail.com',
            'id_categoria' => $id_gerente
        ]);
        $Pessoa->create([
        	'nome' => 'Raphael Souza Santos',
            'email' => 'rsantos@gmail.com',
            'id_categoria' => $id_admin
        ]);
        $Pessoa->create([
        	'nome' => 'Pedro Paulo Mota',
            'email' => 'ppmota@gmail.com',
            'id_categoria' => $id_admin
        ]);
        $Pessoa->create([
        	'nome' => 'Winder Carvalho da Silva',
            'email' => 'winder@hotmail.com',
            'id_categoria' => $id_normal
        ]);
        $Pessoa->create([
        	'nome' => 'Maria da Penha Albuquerque',
            'email' => 'mpa@hotmail.com',
            'id_categoria' => $id_normal
        ]);
        $Pessoa->create([
        	'nome' => 'Rafael Garcia Souza',
            'email' => 'rgsouza@hotmail.com',
            'id_categoria' => $id_normal
        ]);
        $Pessoa->create([
        	'nome' => 'Tabata Costa',
            'email' => 'tabata_costa@gmail.com',
            'id_categoria' => $id_gerente
        ]);
        $Pessoa->create([
        	'nome' => 'Ronil Camarote',
            'email' => 'camarote@terra.com.br',
            'id_categoria' => $id_admin
        ]);
        $Pessoa->create([
        	'nome' => 'Joaquim Barbosa',
            'email' => 'barbosa@globo.com',
            'id_categoria' => $id_admin
        ]);
        $Pessoa->create([
        	'nome' => 'Eveline Maria Alcantra',
            'email' => 'ev_alcantra@gmail.com',
            'id_categoria' => $id_gerente
        ]);
        $Pessoa->create([
        	'nome' => 'João Paulo Vieira',
            'email' => 'jpvieria@gmail.com',
            'id_categoria' => $id_admin
        ]);
        $Pessoa->create([
        	'nome' => 'Carla Zamborlini',
            'email' => 'zamborlini@terra.com.br',
            'id_categoria' => $id_normal
        ]);
    }
}
