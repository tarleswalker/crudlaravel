@extends('templates.template')

@section('content')

<div class="container-xl">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2><b>Cadastrar </b><small> Categoria</small></h2>
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
							<label>Descrição</label>
							<input type="text" class="form-control" name="descricao" id="descricao" required>
						</div>
					</div>
					<div class="col-sm-12 text-center mt-4">
						<div class="form-group">
							<a href="../" class="btn btn-warning m-2">
								Cancelar
							</a>
							<button type="button" class="btn btn-success m-2" id="addcategoria">Cadastrar</button>
						</div>
					</div>
				</div>
			</form>
			
		</div>
	</div>        
</div>

<script>
$(document).ready(function(){

    $("#addcategoria").click(function () {
    	var descricao  = $("#descricao").val();
        if(descricao.length > 0){
        	$("#addcategoria").attr("disabled", true);
            AddCategoria();                
        } else {
	        $.alert({ title: 'Aviso!',
                    content: 'Favor preencher todos os campos!!!',
                    theme: 'material',
                    buttons: { Ok: { btnClass: 'btn-blue', action: function () {} } }
            });                   
        }       
    });


    function AddCategoria(){

        $.ajax({
        	headers: {
		        'X-CSRF-Token': $('input[name="_token"]').val()
		    },
            url: "/categoria/add",
            type: "POST",
            data: {
                descricao: $("#descricao").val()               
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