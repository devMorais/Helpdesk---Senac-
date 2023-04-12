<div class="container my-3">

<!-- JavaScript (Opcional) -->
    
<!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<?php 

if(isset($_GET['id_chamado']))
{
	$id = $_GET['id_chamado'];
	$id_usuario = $_SESSION['id_user'];
}else{
	$id = 0;
}

?>

 <ul class="nav nav-tabs" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" data-bs-toggle="tab" href="#detalhe">Detalhes</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-bs-toggle="tab" href="#comentario">Comentários</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-bs-toggle="tab" href="#anexo">Anexos</a>
  </li>
</ul>

<!-- Tab panes -->
<div class="tab-content mt-3">

<?php 
include_once("classes/funcoessql.php");
   
   
   
//objeto para tratar o select dos chamados
$detalhes = new funcoessql();
				   $detalhes->setconsulta("SELECT ch.id_chamado, ch.assunto, ch.descricao_chamado, cat.desc_categoria,
					   sta.desc_status, pri.desc_prioridade, usu.nome,
					   date_format(data_abertura,'%d/%m/%Y') data_abertura, id_status, id_prioridadae, id_categoria
				 FROM categoria  cat,
					  usuario    usu,
					  status     sta,
					  prioridade pri,
					  chamado    ch
				WHERE id_chamado        = ".$id."
				  and ch.fk_categoria   = cat.id_categoria 
				  and ch.fk_usuario     = usu.id_usuario
				  and ch.fk_status      = sta.id_status
				  and ch.fk_prioridadae = pri.id_prioridadae");
 
 
 
 
 echo" <div class='tab-pane container active'  id='detalhe'>";	
 
 if($detalhes->total() > 0)	
 {	
//varre o resultado do select e mostra o resultado na div detalhe
     
	 
	 
	 foreach($detalhes->ler() as $d)
	{
 if($_SESSION['desc_tipo'] == "ANALISTA")
 {
	   echo "		 
		 
	<form class=form-control method=post action=manter_detalhes.php?id=$id>
			 <input type=hidden value=".$d['id_categoria']." name=cat_atual></input>
			 <input type=hidden value=".$d['id_status']." name=st_atual></input>
			 <input type=hidden value=".$d['id_prioridadae']." name=pri_atual></input>";		
	echo "
			<table class='table table-dark table-sm table-striped table table-bordered border-success text-center'>
				<thead class='thead-dark'>
					<tr>	  
						<th scope='col'>#</th>
						<th scope='col'>Status</th>
						<th scope='col'>Prioridade</th>
						<th scope='col'>Categoria</th>
						<th scope='col'>Usuario</th>
						<th scope='col'>Data</th>
						<th scope='col'>Assunto</th>
						<th scope='col'>Descrição</th>		
					</tr>			
				</thead>
				<tbody>	  		   
				<tr>
		  
			<th>$d[id_chamado]</th>
		  
		  
		  <td><select name=newstatus>";
		  
		 
		  
		  $st = new funcoessql();
			 $st->setconsulta("select * from status");
			 foreach($st->ler() as $s){
				 if($d['id_status'] == $s[0])
				 {
					echo "<option value=$s[0] selected>$s[1]</option>"; 
				 }else{
					echo "<option value=$s[0]>$s[1]</option>"; 
				 }
			 }  
	echo " </select> </td>
		 <td><select name=newprioridade>";
		  $ct = new funcoessql();
		  $pr = new funcoessql();
			$pr->setconsulta("select * from prioridade");
			foreach($pr->ler() as $p)
			{
			   if($d['id_prioridadae']==$p[0])
			   {
				   echo "<option value=$p[0] selected>$p[1]</option>";
			   }else{
				   echo "<option value=$p[0]>$p[1]</option>";
			   }
			}	  
	echo " </select> </td>
		  
		  
		  <td><select name=newcategoria>";
		  $ct = new funcoessql();
			$ct->setconsulta("select id_categoria, desc_categoria from categoria");
			foreach($ct->ler() as $c)
			{
			   if($d['id_categoria'] == $c[0])
			   {
			      echo "<option value=$c[0] selected>$c[1]</option>";
			   }else{
				   echo "<option value=$c[0]>$c[1]</option>";
			   }
			}
		
		echo"	</select>  </td>
		
		 <td>$d[nome]</td>	  
		 <td>$d[data_abertura]</td>
		 <td>$d[assunto]</td>
		 <td>$d[descricao_chamado]</td>
		</tr>
		</tbody>
		</table>
		 <button type='submit' class='btn btn-outline-warning text-dark btn-sm col-12' name=atualizar class='btn'>ATUALIZAR</button>
 </form>
 
		<dl class='row lead shadow-lg p-3 mb-5 bg-body rounded text-dark'>
		
		<dt class='col-sm-3'>Número do chamado:</dt>
		  
		  <dd class='col-sm-9'><mark>$d[id_chamado]</mark> </dd> 
		  <dt class='col-sm-3'>Usuario:</dt>
		  
		  <dd class='col-sm-9'><mark>$d[nome]</mark> </dd> 

		  <dt class='col-sm-3'>Assunto:</dt>
		  <dd class='col-sm-9'>
			<p><mark><td>$d[assunto]</mark></td</p>
			<p><mark>$d[descricao_chamado]</mark></p>
		  </dd>

		  <dt class='col-sm-3'>Prioridade:</dt>
		  <dd class='col-sm-9'><mark><th>$d[desc_prioridade]</th></mark></dd>

		  <dt class='col-sm-3 text-truncate'>Categoria:</dt>
		  <dd class='col-sm-9'>	<mark><th>$d[desc_categoria]</th></mark></dd>

		  <dt class='col-sm-3'><td> Aberto em : <mark>$d[data_abertura]</mark></td></dt>
		  <dd class='col-sm-9'>
			<dl class='row'>
			  <dt class='col-sm-4'> Com status:</dt>
			  <dd class='col-sm-8'><mark>$d[desc_status]</mark></dd>
			</dl>
		  </dd>
		</dl>
		";
	} elseif($_SESSION['desc_tipo'] == "USUARIO"){
		
			
		echo "
		
		<dl class='row lead shadow-lg p-3 mb-5 bg-body rounded text-dark'>
		  <dt class='col-sm-3'>Número do chamado:</dt>
		  
		  <dd class='col-sm-9'><mark>$d[id_chamado]</mark> </dd> 
		  
		  <dt class='col-sm-3'>Usuario:</dt>
		  
		  <dd class='col-sm-9'><mark>$d[nome]</mark> </dd> 

		  <dt class='col-sm-3'>Assunto:</dt>
		  <dd class='col-sm-9'>
			<p><mark><td>$d[assunto]</mark></td</p>
			<p><mark>$d[descricao_chamado]</mark></p>
		  </dd>

		  <dt class='col-sm-3'>Prioridade:</dt>
		  <dd class='col-sm-9'><mark><th>$d[desc_prioridade]</th></mark></dd>

		  <dt class='col-sm-3 text-truncate'>Categoria:</dt>
		  <dd class='col-sm-9'>	<mark><th>$d[desc_categoria]</th></mark></dd>

		  <dt class='col-sm-3'><td> Aberto em : <mark>$d[data_abertura]</mark></td></dt>
		  <dd class='col-sm-9'>
			<dl class='row'>
			  <dt class='col-sm-4'> Com status:</dt>
			  <dd class='col-sm-8'><mark>$d[desc_status]</mark></dd>
			</dl>
		  </dd>
		</dl>
		
		
		
		
		
		<table class='table table-dark table-striped table table-bordered border-success text-center'>
				<thead class='thead-dark'>
					<tr>	  
						<th scope='col'>#</th>
						<th scope='col'>Status</th>
						<th scope='col'>Prioridade</th>
						<th scope='col'>Categoria</th>
						<th scope='col'>Usuario</th>
						<th scope='col'>Data</th>
						<th scope='col'>Assunto</th>
						<th scope='col'>Descrição</th>		
					</tr>			
				</thead>
				<tbody>	  		   
		<tr>
		  
			<th>$d[id_chamado]</th>
			<th>$d[desc_status]</th>
			<th>$d[desc_prioridade]</th>
			<th>$d[desc_categoria]</th>
			<td>$d[nome]</td>	  
			<td>$d[data_abertura]</td>
			<td>$d[assunto]</td>
			<td>$d[descricao_chamado]</td>
		</tr>
		</tbody>
		</table>";	
	}
		
 }
 
}

 echo" </div>"; 
 
//objeto para tratar o select dos comentários 
   
   $comentario = new funcoessql();
   $comentario->setconsulta("SELECT usu.nome, 
					   
					   cm.comentario, 
					   date_format(cm.data_comentario,'%d/%m/%Y') data_comentario
				from usuario usu, comentario cm
				where cm.fk_usuario = usu.id_usuario
				and cm.fk_chamado   = ".$id."
				order by cm.data_comentario");
				
				
echo "<div class='tab-pane container fade' id='comentario'>";  // inicia a sessao dos comentarios
	
	if($comentario->total() > 0)
	{
	 
		 
//varre o resultado do select e mostra o resultado na div comentario
		  
		  foreach($comentario->ler() as $c)
		  {
			  
echo "<p class='table table-success table-striped mt-3 table-bordered border-dark'>
Em: ".$c[2]." O Usuario: ".$c[0].": <strong>".$c[1]."</strong><br><hr>

	</p>";

		  }
		
	}
	 
	 echo // formulário do comentario
				
				"<div class='container mt-2 p-0'>
						<form class=form-control method=post action=manter_detalhes.php?id=$id>
						<div class='mb-3 mt-3'>
						  <label class='text-dark h4'>Inserir comentário:</label>
						  <textarea class='form-control' maxlength=1000 rows='5' required name='text'></textarea>
						</div>
		<button type='submit' name='enviar' class='btn btn-success me-3 lead'>Comentar</button>
					  </form>
				
				</div>";
				
echo "</div>";  //fecha a sessao dos comentarios   


//objeto para tratar o select dos anexos
	$anexo = new funcoessql();
	$anexo->setconsulta("SELECT arq.nome_arquivo ,
					   usu.nome,
					   date_format(arq.data_inclusao,'%d/%m/%Y') data_inclusao
						FROM arquivo arq,
							 usuario usu
						where arq.fk_usuario = usu.id_usuario 
						  and arq.fk_chamado = ".$id."
						order by arq.data_inclusao");



echo "<div class='tab-pane fade' id='anexo'>";  // sessao dos anexos 
	
	if($anexo->total() > 0)
	{
		
//varre o resultado do select e mostra o resultado na div anexo
		
		foreach($anexo->ler() as $l)
		{
	      
		  echo "Em ".$l['data_inclusao']." o usuário ".$l['nome']." anexou: <br> 
		  <a href=arquivo/".$l['nome_arquivo']." target='_blank'>".$l['nome_arquivo']." </a><hr>";
 
		}
	}	
		
	
echo 	// formulário do anexos
		 
		 "<div class='container mt-3'>
		<label class='text-dark h4'>Inserir anexo:</label>
				<form method=post enctype='multipart/form-data' action=manter_detalhes.php?id=$id>
					<div class='mb-3 mt-3'>
					<input type=file name=arquivo required>
					</div>
					<button type='submit' name=envarq class='btn btn-success me-3 lead'>Anexar</button>
				</form>	  
		 </div>";
		
echo "</div>";  // fecha sessao dos anexos
	

 ?>
 </div>
 
 </div>
 
												









