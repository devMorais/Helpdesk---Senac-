<main>
  <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item">
        <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"/></svg>
        <div class="container">
          <div class="carousel-caption text-end">
            <h1>One more for good measure.</h1>
            <p>Some representative placeholder content for the third slide of this carousel.</p>
            <p><a class="btn btn-lg btn-primary" href="#">Browse gallery</a></p>
          </div>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
  
<div class="container marketing"> 
    
<div class="row">
      
	  <?php 
	  if(isset($_GET['idcat']))
	  {
		  $idcat = $_GET['idcat'];
	  }else{
		  $idcat = 0;
	  }
	  
	  
	  //verifica se o id do usuario existe na session
	  if(isset($_SESSION['id_user']))
	  {
		  $id_user = $_SESSION['id_user'];
	  }else{
		  $id_user = 0;
	  }
	  
	  if(isset($_SESSION['desc_tipo']))
	  {
		  $desc_tipo = $_SESSION['desc_tipo'];
	  }else{
		  $desc_tipo = "";
	  }
	  
	 include_once("classes/funcoessql.php");
		$chamado = new funcoessql();

		if($desc_tipo == "USUARIO")
		{
			$chamado->setconsulta("select id_chamado, assunto, descricao_chamado from chamado where fk_categoria = $idcat and fk_usuario = $id_user");
		}
		else if($desc_tipo == "ANALISTA")
		{
			$chamado->setconsulta("select id_chamado, assunto, descricao_chamado from chamado where fk_categoria = $idcat");
		}

		if($chamado->total() > 0)
		{
			foreach($chamado->ler() as $c)
			{	
				echo "<div class='col-lg-4'>";
				
				// Criei este objeto para adicionar as imagens referente a categoria selecionada
				// Na hora que o aministrador cadastra essa categoria a imagem vai para a pasta adm/arquivo/ pasta que eu criei também.
				// Sendo uma pasta arquivo para os anexos e outra para o adm.
				
				$img = new funcoessql();
				$img->setconsulta("select imagem from categoria where id_categoria = $idcat");

				if($img->total() > 0)
				{
					$imagem = $img->ler()[0][0];
					echo "<img  width='80' height='80' src='adm/arquivo/" . $imagem . "'>";
				}

				echo "<h2 class='h3'>".$c['assunto']."</h2>
					  <p class=lead>".$c['descricao_chamado']."</p>
					  
					  <p><a class='btn btn-success' href='index.php?pag=detalhes&id_chamado=".$c['id_chamado']." '>DETALHES</a></p>
					
					  </div>";
					  
			}
		}
		else
		{
			echo "<p class=lead>Sem chamados</p>";
		} 
?>
      
</div><!-- /.row -->

