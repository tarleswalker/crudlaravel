@extends('templates.template')

@section('content')

<div class="container-xl">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2><b>Pessoas </b><small> Registros cadastrados</small></h2>
					</div>
					<div class="col-sm-6">
						@csrf
						<a href="{{url('categoria/create')}}" class="btn btn-warning">
							<i class="material-icons">&#xE147;</i> <span>Adicionar Categoria</span>
						</a>						
						<a href="{{url('pessoa/create')}}" class="btn btn-success">
							<i class="material-icons">&#xE147;</i> <span>Adicionar Pessoa</span>
						</a>
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				@if(!$AllPessoas->isEmpty())
				<thead>
					<tr>
						<th>Nome</th>
						<th>E-mail</th>
						<th>Categoria</th>
						<th>Ações</th>
					</tr>
				</thead>
				<tbody>		         
		            @foreach($AllPessoas as $Pessoa)
		                @php
		                    $Categoria = $Pessoa->find($Pessoa->id)->relCategoria;
		                @endphp
		                <tr>
		                    <th scope="row">{{$Pessoa->nome}}</th>
		                    <td>{{$Pessoa->email}}</td>
		                    <td>{{$Categoria->descricao}}</td>
		                    <td>
		                        <a href="{{url("pessoa/$Pessoa->id/edit")}}" class="edit"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
								<a href="#" pessoa="{{$Pessoa->id}}" class="delete"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
		                    </td>
		                </tr>
		            @endforeach
		        @else
                <tr>
                    <td colspan="4">Nenhum registro encontrado</td>
                </tr>
                @endif

				</tbody>
			</table>
			@if($Total>0)
			<div class="clearfix">
				<div class="hint-text">
					<span id="RecebeNomePaginasPessoa">Exibindo <b>5</b> de <b>{{$Total}}</b> registros encontrados</span>
				</div>
				{{ $AllPessoas->links() }}
			</div>
			@endif
		</div>
	</div>        
</div>


@endsection

@section('js')
<script src="/assets/js/validator/jquery.validate.min.js"></script>
<script src="/assets/js/jqueryconfirm/jquery-confirm.min.js"></script>
<script>
$(document).ready(function(){

    $(".delete").click(function () {
    	var id = $(this).attr("pessoa");
        if(!isNaN(id)){
        	$.alert({ title: 'Aviso!',
                    content: 'Deseja deletar esta pessoa?',
                    theme: 'material',
                    buttons: { Não: { btnClass: 'btn-default', action: function () {} },
                    		   Deletar: { btnClass: 'btn-red', action: function () { DeletarPessoa(id); } }
                    }
            });                
        }     
    });


    function DeletarPessoa(id){

        $.ajax({
        	headers: {
		        'X-CSRF-Token': $('input[name="_token"]').val()
		    },
            url: "/pessoa/"+id,
            type: "DELETE",
            data: { },
            success: function (response) {
                if (response != ""){
                    $.confirm({ title: 'Ok!',
                        content: 'Pessoa excluída com sucesso!',
                        theme: 'light',
                        type: 'dark',
                        typeAnimated: true,
                        buttons: { Ok: { btnClass: 'btn-blue', action: function () { window.location = "/"; } } }
                    });
                } else {
                    $.alert({ title: 'Erro!',
                        content: 'Ocorreu um erro ao excluir!!!',
                        theme: 'material',
                        buttons: { Ok: { btnClass: 'btn-blue', action: function () {} } }
                    });
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {

            	var mensagem = "";
            	var chaves = Object.keys(jqXHR.responseJSON.errors);
            	for (i of chaves) {
				  for(x of jqXHR.responseJSON.errors[i]){
				  	mensagem = mensagem + ' ' + x;
				  }
				}
                
                $.alert({ title: 'Erro!',
                    content: 'Ocorreu um erro ao excluir! ' + mensagem,
                    theme: 'material',
                    buttons: { Ok: { btnClass: 'btn-blue', action: function () {} } }
            	}); 
            }
        });
    }
    // Activate tooltip
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
@endsection
