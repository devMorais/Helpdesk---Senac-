<!DOCTYPE html>
<div class="container mt-3"
<html lang="pt-br">
  <head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	
	
	
	<!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  

    <title>Manter usuário</title>
  </head>
  <body>
  
   <table class="table table-hover table-responsive-md my-4 table-sm table-bordered text-center">
  <thead class="bg-warning">
    <tr>

	  <th scope="col">ID</th>
      <th scope="col">Nome</th>
      <th scope="col">Email</th>
	  <th scope="col">Senha</th>
	  <th scope="col">Tipo do usuario</th>
	  <th scope="col">Celular</th>
	  <th scope="col" colspan=2>Ações</th>

	  
	  <th> <button type='button'  data-toggle="modal" 
	  data-target="#modalInserir">🞧</button><th>
      
    </tr>
  </thead>
  <tbody>
  
  
<?php
  
  //url do arquivo funcoessql
  include_once("../classes/funcoessql.php");
  // objeto do tipo funcoessql
  
  $tpu = new funcoessql();
  $tpu->setconsulta("select id_usuario, nome, email, senha, fk_tipousuario, celular  from usuario");
  
  // buscando informações do banco helpdesk 
  if($tpu->total() > 0)
 {
	
	  
	  foreach($tpu->ler() as $p)
	  {
		  // Botões alterar e excluir
		
		echo "
		<tr>
		  
		 
		  <th scope='row'>$p[id_usuario]</th>
		  <td>$p[nome]</td>
		  <td>$p[email]</td>
		  <td>$p[senha]</td>
		  <td>$p[fk_tipousuario]</td>
		  <td>$p[celular]</td>
		  
		  
		 <td>
    <button type='button' 
            
			class='btn btn-primary btn-sm' 
            data-toggle='modal' 
            data-target='#modalAlterar' 
            data-whatever='$p[id_usuario]' 
            data-whatevermsg='$p[nome]'
            data-whatevermsg2='$p[email]'
            data-whatevermsg3='$p[senha]'
            data-whatevermsg1='$p[fk_tipousuario]'
            data-whatevermsg4='$p[celular]'
    >
        Alterar
    </button>
		 
		 </td>  
		  <td><button type='button' class='btn btn-danger btn-sm' 
		  data-toggle='modal' 
		  data-target='#modalExcluir' 
		  
		  data-whatever='$p[0]'
		  data-whatevermsg='$p[1]'>Excluir</button></td>
		
		</tr>";
	  }
 }
   
?>
    
  </tbody>
</table>

<!--MODAL ALTERAR -->
<div class="modal fade" id="modalAlterar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nova mensagem</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    
	<form method=post action=funcoes_usuario.php>  
		  
		  <div class="form-group">
            <label for="recipient-name" class="col-form-label">ID Usuario</label>
            <input type="text" class="form-control" name=idusu required id="recipient-name" readonly>
          </div>
          
		  <div class="form-group">
            <label for="message-text" class="col-form-label"> Nome:</label>
            <input type="text" class="form-control" name=nomeusuario id="message-text" required> 
			
          </div>
		  
		   <div class="form-group">
            <label for="recipient-name" class="col-form-label">Email</label>
            <input type="text" class="form-control" name=email id="message-text2">  
          </div>
		  
		   <div class="form-group">
            <label for="recipient-name" class="col-form-label">Senha</label>
            <input type="text" class="form-control" name=senha id="message-text3">  
          </div>
		  
		   
					<label>Tipo de usuario</label><br>
					<select name=tipousuario id="message-text1">
						 
						 <?php
							include_once("../classes/funcoessql.php");
							$tipoalterar = new funcoessql();
							
							$tipoalterar->setconsulta("SELECT * FROM tipousuario");

							if($tipoalterar->total() > 0)
							{								
							  foreach($tipoalterar->ler() as $tpa) 
							  {
								  echo "<option value=$tpa[0]>$tpa[1]</option>"; 
								
							  }
							}
						  ?>
					</select>
  <div class="form-group">
            <label for="recipient-name" class="col-form-label">Celular</label> 
            <input type="text" class="form-control" name=cel id="message-text4">   <!-- message-text4 = senha -->
          </div>
	  </div>
  
	  <div class="modal-footer">
        
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="submit" name=altusuario class="btn btn-primary">Alterar</button>
      
	  </div>
	
	
	</form>
    </div>
  </div>
</div>



<!--MODAL EXCLUIR -->

<div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nova mensagem</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    
	<form method=post action=funcoes_usuario.php>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">ID Usuario</label>
            <input type="text" class="form-control" name=idusu id="recipient-name" readonly>
          </div>
          
		  
		  <div class="form-group">
            <label for="message-text" class="col-form-label"> Descrição:</label>
            <textarea class="form-control" disabled id="message-text"></textarea>
          </div>
       
      
	  
	  </div>
      
	  
	  <div class="modal-footer">
        
		<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
        <button type="submit" name=excusu class="btn btn-primary">Excluir</button>
      
	  </div>
	</form>
    </div>
  </div>
</div>

<!--MODAL INSERIR -->

<div class="modal fade" id="modalInserir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Informe os dados</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    
	<form method=post action=funcoes_usuario.php>
          
		  <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nome Usuario</label>
            <input type="text" class="form-control" name=nomeusu required>
          </div>
		  
		   <div class="form-group">
            <label for="recipient-name" class="col-form-label">Email</label>
            <input type="text" class="form-control" name=email required id="recipient-name">
          </div>
		  
		   <div class="form-group">
            <label for="recipient-name" class="col-form-label">Senha</label>
            <input type="text" class="form-control" required name=senha id="recipient-name">
          </div>
		  
		<label>Tipo de usuario</label>
		<select name=tipousuario required> 
	
		<?php
		
		include_once("../classes/funcoessql.php");
		
		$tipo = new funcoessql();
		$tipo->setconsulta("SELECT  *  FROM tipousuario");

		if($tipo->total() > 0)			
		{			
			foreach($tipo->ler() as $tp)
			{				
				echo '<option value="'.$tp['id_tipousuario'].'">'.$tp['desc_tipo'].'</option>';
			};
		}
		?> 
		</select>
		  
		   
		   <div class="form-group">
            <label for="recipient-name" class="col-form-label">Celular</label>
            <input type="text" class="form-control" name=cel required id="recipient-name">
          </div>
	  <div class="modal-footer">
        
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" name=insusu class="btn btn-primary">Inserir</button>
      
	  </div>
	</form>
    </div>
  </div>
</div>



<script text=javascript>

$('#modalAlterar').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Botão que acionou o modal
  var recipient = button.data('whatever') // Extrai informação dos atributos data-*
  var recipientmsg  = button.data('whatevermsg')
  var recipientmsg1 = button.data('whatevermsg1')
  var recipientmsg2 = button.data('whatevermsg2')
  var recipientmsg3 = button.data('whatevermsg3')
  var recipientmsg4 = button.data('whatevermsg4')
  
  // Se necessário, você pode iniciar uma requisição AJAX aqui e, então, fazer a atualização em um callback.
  // Atualiza o conteúdo do modal. Nós vamos usar jQuery, aqui. No entanto, você poderia usar uma biblioteca de data binding ou outros métodos.
  var modal = $(this)
  modal.find('.modal-title').text('Alterar o registro: ' + recipient)
  modal.find('.modal-body input').val(recipient)
  modal.find('#message-text').val(recipientmsg)
  modal.find('#message-text1').val(recipientmsg1)
  modal.find('#message-text2').val(recipientmsg2)
  modal.find('#message-text3').val(recipientmsg3)
   modal.find('#message-text4').val(recipientmsg4)
})


</script>

<script text=javascript>

$('#modalExcluir').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Botão que acionou o modal
  var recipient = button.data('whatever') // Extrai informação dos atributos data-*
  var recipientmsg = button.data('whatevermsg')
  // Se necessário, você pode iniciar uma requisição AJAX aqui e, então, fazer a atualização em um callback.
  // Atualiza o conteúdo do modal. Nós vamos usar jQuery, aqui. No entanto, você poderia usar uma biblioteca de data binding ou outros métodos.
  var modal = $(this)
  modal.find('.modal-title').text('Deseja excluir o registro: ' + recipient)
  modal.find('.modal-body input').val(recipient)
  modal.find('#message-text').val(recipientmsg)
})


</script>
	

  
  </body>
</html>