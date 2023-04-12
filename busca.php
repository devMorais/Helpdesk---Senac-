<main>
  <div id="myCarousel" class="carousel slide lead" data-bs-ride="carousel">
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


  <!-- Marketing messaging and featurettes
  ================================================== -->
  <!-- Wrap the rest of the page in another container to center all the content. -->

  <div class="container marketing">

    <!-- Three columns of text below the carousel -->
    <div class="row">
      
	  <?php 
	 
	 //verifica se o id do usuario existe na session
	  if(isset($_SESSION['id_user']))
	  {
		  $id_user = $_SESSION['id_user'];
	  }else{
		  $id_user = 0;
	  }
	  
	  if(isset($_SESSION['desc_tipo']))
	  {
		  $tipo_user = $_SESSION['desc_tipo'];
	  }else{
		  $tipo_user = "";
	  }
	  
	  include_once("classes/funcoessql.php");
	  $chamado = new funcoessql();
	  
	  if($tipo_user == "USUARIO")
	  {
	     $chamado->setconsulta("select id_chamado, assunto, descricao_chamado, imagem from chamado, categoria where fk_categoria= id_categoria and fk_usuario = $id_user and assunto like '%".$_POST['chave']."%'");
	  
	  
	  }else{
		  $chamado->setconsulta("select id_chamado, assunto, descricao_chamado, imagem from chamado, categoria where fk_categoria= id_categoria and assunto like '%".$_POST['chave']."%'");
	  }
	  
	  
	  
	  
	  if($chamado->total() > 0)
	  {
		  foreach($chamado->ler() as $c)
		  {
			  echo "<div class='col-lg-4'>
			        <img  width='80' height='80' src='adm/arquivo/" . $c['imagem'] . "'>";
				
				
			  echo "<h2>".$c['assunto']."</h2>
				<p>".$c['descricao_chamado']."</p>
				<p><a class='btn btn-success' href='index.php?pag=detalhes&id_chamado=".$c['id_chamado']." '>DETALHES</a></p>
			  </div>";
		  }
	  }else{
		  echo "Sem chamados com a palavra chave informada";
	  }
	 ?>
      
    </div><!-- /.row -->
