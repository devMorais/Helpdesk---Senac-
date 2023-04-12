<!DOCTYPE html>
<div class="container mt-3"
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
  

    <title>Manter Categoria</title>
  </head>
  <body>
   <table class="table table-hover table-responsive-md my-4 table-sm table-bordered text-center">
  <thead class="bg-warning">
    <tr>
      
	  <th scope="col">ID</th>
      <th scope="col">Descrição</th>
      <th scope="col">Imagem</th>
	  <th scope="col" colspan=2 class="text-center">Ações</th>
	  <th> <button type='button'data-toggle="modal" 
	  data-target="#modalInserir">🞧</button><th>
      
    </tr>
  </thead>
  <tbody>
  
  
<?php
  
  //url do arquivo funcoessql
  include_once("../classes/funcoessql.php");
  // objeto do tipo funcoessql
  
  $cat = new funcoessql();
  $cat->setconsulta("select id_categoria, desc_categoria, imagem from categoria");
  
  // buscando informações do banco helpdesk 
  if($cat->total() > 0)
 {
	  
	  foreach($cat->ler() as $c)
	  {
		  // Botões alterar e excluir
		
		echo "
		<tr>	 
		  <th scope='row'>$c[0]</th>
		  <td>$c[1]</td>
		  <td><img width='40' height='40' src='arquivo/".$c['imagem']."'></td>
	  <td><button type='button' 
		  class='btn btn-primary btn-sm' 
		  data-toggle='modal' 
		  data-target='#modalAlterar' 
		  
		  data-whatever='$c[0]' 
		  data-whatevermsg='$c[1]'>Alterar</button></td>
  
		  <td><button type='button' class='btn btn-danger btn-sm' 
		  data-toggle='modal' 
		  data-target='#modalExcluir' 
		  
		  data-whatever='$c[0]'
		  data-whatevermsg='$c[1]'>Excluir</button></td>
		
		</tr>
		
		";
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
    
	<form method=post enctype="multipart/form-data" action=funcoes_categoria.php>
            
		  <div class="form-group">
            <label for="recipient-name" class="col-form-label">ID Categoria</label>
            <input type="text" class="form-control" name=idcat id="recipient-name" readonly>
          </div>
          
		  <div class="form-group">
            <label for="message-text" class="col-form-label"> Descrição:</label>
            <textarea class="form-control" name=desccat id="message-text" required></textarea>
          </div>
		  
		  </div>
		  
		  <div class="mx-auto">
            <label for="message-text" class="col-form-label"> Altere a imagem:</label>
            <input type=file name=arquivo class="form" required  > </input><br>
          </div>
		  
		  
	  
	  <div class="modal-footer">
        
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="submit" name=altcat class="btn btn-primary">Alterar</button>
      
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
    
	<form method=post action=funcoes_categoria.php>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">ID Categoria</label>
            <input type="text" class="form-control" name=idcat id="recipient-name" readonly>
          </div>
          
		  
		  <div class="form-group">
            <label for="message-text" class="col-form-label"> Descrição:</label>
            <textarea class="form-control" disabled id="message-text"></textarea>
          </div>
		  
		  
		  
       
      
	  
	  </div>
      
	  
	  <div class="modal-footer">
        
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" name=exccat class="btn btn-primary">Excluir</button>
      
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
    
	<form method=post enctype="multipart/form-data" action=funcoes_categoria.php>
          
		  <div class="form-group">
            <label for="recipient-name" class="col-form-label">Descrição categoria</label>
            <input type="text" class="form-control" name=desccat required>
          </div>
          
		  
		  <div class="form-group">
            <label for="message-text" class="col-form-label"> Insira uma imagem:</label>
            <input type=file name=arquivo class="form"> </input>
          </div>
       
      
	  
	  </div>
      
	  
	  <div class="modal-footer">
        
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" name=inscat class="btn btn-primary">Inserir</button>
      
	  </div>
	</form>
    </div>
  </div>
</div>



<script text=javascript>

$('#modalAlterar').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Botão que acionou o modal
  var recipient = button.data('whatever') // Extrai informação dos atributos data-*
  var recipientmsg = button.data('whatevermsg')
  // Se necessário, você pode iniciar uma requisição AJAX aqui e, então, fazer a atualização em um callback.
  // Atualiza o conteúdo do modal. Nós vamos usar jQuery, aqui. No entanto, você poderia usar uma biblioteca de data binding ou outros métodos.
  var modal = $(this)
  modal.find('.modal-title').text('Alterar o registro: ' + recipient)
  modal.find('.modal-body input').val(recipient)
  modal.find('#message-text').val(recipientmsg)
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