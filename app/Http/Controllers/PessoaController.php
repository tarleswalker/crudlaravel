<?php

namespace App\Http\Controllers;

use App\Http\Requests\PessoaRequest;
use App\Models\ModelPessoa;
use App\Models\ModelCategoria;

class PessoaController extends Controller
{

    private $ObjPessoa;
    private $ObjCategoria;

    public function __construct()
    {
        $this->ObjPessoa    = new ModelPessoa();
        $this->ObjCategoria = new ModelCategoria();
    }

    /**
     * Exibição tela principal, com tabela de pessoas cadastradas.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $AllPessoas = $this->ObjPessoa->paginate(5);
        $Total = $this->ObjPessoa->all()->count();
        return view('index', compact('AllPessoas', 'Total'));
    }

    /**
     * Exibição da tela de cadastro de pessoas
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $AllCategorias = $this->ObjCategoria->all()->sortBy('id');
        return view('pessoa.create', compact('AllCategorias') );
    }

     /**
     * Registra as informações de cadastro de uma pessoa no banco de dados.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add(PessoaRequest $request)
    {
        $formdata = $request->all();
    
        $nome      = $formdata['nome'];
        $email     = $formdata['email'];
        $categoria = intval($formdata['categoria']);

        $Status = $this->ObjPessoa->create([
            'nome' => $nome,
            'email' => $email,
            'id_categoria' => $categoria
        ]);
        
        return response()->json($Status);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PessoaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Exibição da tela de edição de informações de uma pessoa cadastrada.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Pessoa        = $this->ObjPessoa->find($id);
        $AllCategorias = $this->ObjCategoria->all();
        return view('pessoa.edit',compact('Pessoa','AllCategorias'));
    }

    /**
     * Atualiza as informações de uma pessoa no banco de dados.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PessoaRequest $request, $id)
    {
        
        $formdata = $request->all();
    
        $nome      = $formdata['nome'];
        $email     = $formdata['email'];
        $categoria = intval($formdata['categoria']);

        $Status = $this->ObjPessoa->where(['id'=>$id])->update([
            'nome'=>$nome,
            'email'=>$email,
            'id_categoria'=>$categoria
        ]);
        
        return response()->json($Status);
    }

    /**
     * Exclui determinada pessoa.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Status = $this->ObjPessoa->destroy($id);
        
        return response()->json($Status);
    }
}
