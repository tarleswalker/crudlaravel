@extends('templates.template')

@section('content')

<div class="container-xl">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2><b>Cadastrar </b><small> Pessoa</small></h2>
					</div>
					<div class="col-sm-6">
						<a href="{{url('../')}}" class="btn btn-default"><i class="material-icons">&#xe5e0;</i> <span>Voltar</span></a>
					</div>
					@if(isset($errors) && count($errors)>0)
						<div class="col-sm-12">
						    <div class="text-center mt-4 mb-4 p-2 alert-danger">
						        @foreach($errors->all() as $erro)
						            {{$erro}}<br>
						        @endforeach
						    </div>
						</div>
					@endif
				</div>
			</div>
			<form name="formcadpessoa" id="formcadpessoa" method="post">
				<div class="row">
					@csrf
					<div class="col-sm-12">
						<h4 class="modal-title">Informe os dados abaixo</h4>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>Nome</label>
							<input type="text" class="form-control" name="nome" id="nome" required>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>E-mail</label>
							<input type="email" class="form-control" name="email" id="email" required>
						</div>
					</div>
					<div class="col-sm-6">
						<label>Categoria</label>
						<select class="form-control" name="categoria" id="categoria">
							@if(!$AllCategorias->isEmpty())
								@foreach($AllCategorias as $Categoria)
					                <option value="{{$Categoria->id}}">{{$Categoria->descricao}}</option>
					            @endforeach
					        @else
			                	<option value="">Nenhuma Categoria Cadastrada</option>
			                @endif
						</select>
					</div>
					<div class="col-sm-12 text-center mt-4">
						<div class="form-group">
							<a href="{{url('../')}}" class="btn btn-warning m-2">
								Cancelar
							</a>
							<button type="button" class="btn btn-success m-2" id="addpessoa">Cadastrar</button>
						</div>
					</div>
				</div>
			</form>
			
		</div>
	</div>        
</div>

<script>
$(document).ready(function(){

    $("#addpessoa").click(function () {
    	var nome  = $("#nome").val();
        var email = $("#email").val(); 
        var categoria = $("#categoria").val(); 
        if(nome.length > 0 && email.length > 0 && categoria.length > 0){
        	$("#addpessoa").attr("disabled", true);
            AddPessoa();                
        } else {
	        $.alert({ title: 'Aviso!',
                    content: 'Favor preencher todos os campos!!!',
                    theme: 'material',
                    buttons: { Ok: { btnClass: 'btn-blue', action: function () {} } }
            });                   
        }       
    });


    function AddPessoa(){

        $.ajax({
        	headers: {
		        'X-CSRF-Token': $('input[name="_token"]').val()
		    },
            url: "/pessoa/add",
            type: "POST",
            data: {
                nome: $("#nome").val(),
                email: $("#email").val(),
                categoria: $("#categoria").val()               
            },
            success: function (response) {
                if (response != ""){
                    $.confirm({ title: 'Sucesso!',
                        content: 'Inserido com Sucesso!',
                        theme: 'light',
                        type: 'dark',
                        typeAnimated: true,
                        buttons: { Ok: { btnClass: 'btn-blue', action: function () { window.location = "/"; } } }
                    });
                } else {
                    $.alert({ title: 'Erro!',
                        content: 'Ocorreu um erro ao salvar!!!',
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
                    content: 'Ocorreu um erro ao salvar! ' + mensagem,
                    theme: 'material',
                    buttons: { Ok: { btnClass: 'btn-blue', action: function () { $("#addpessoa").attr("disabled", false); } } }
            	}); 
            }
        });
    }
    
});
</script>

@endsection

@section('js')
<script src="/assets/js/validator/jquery.validate.min.js"></script>
<script src="/assets/js/jqueryconfirm/jquery-confirm.min.js"></script>
@endsection