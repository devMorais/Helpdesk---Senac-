<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<?php 
session_start();
include_once("verificar.php");
		
		if($_SESSION['desc_tipo'] == 'ADMINISTRADOR')
	{
		echo "<script>
	     window.location.replace('http://localhost/helpdesk/login.php');
		  </script>";
		include_once("sair.php");
	}
?>
<!doctype html>

<!-- MODAL INCLUIR CHAMADO -->
<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
	 
	 
	  <div class="modal-header">
        <h5 class="modal-title lead" id="exampleModalLabel">Usuário: <?php echo isset( $_SESSION['nome_user'] ) ?$_SESSION['nome_user'] : ""; ?></h5>
      

      </div>
	
	 <div class="modal-body">

<form method=post action=manter_chamado.php> 
	  <label class="text-dark h5">Assunto</label>
		<input name="assuntoChamado" class="form-control" required><br>

		<label class="text-dark h5">Descrição: </label>
		<textarea name="descricao" class="form-control" required maxlength="1000"></textarea><br>

		<label class="text-dark h5">Categoria:</label>
		<select class='form-control' name="categoria" required>
		
		<?php
			include_once ("classes/funcoessql.php");
			$categorias = new funcoessql();
			$categorias->setconsulta("SELECT id_categoria, desc_categoria FROM categoria");
			
			if( $categorias->total() > 0 ):
				
				foreach ( $categorias->ler() AS $c ):
					echo "<option value=" .$c['id_categoria'].">"
							.$c['desc_categoria']. "</option>";
				endforeach;
			else:
				echo "erro";
			endif;
		?>
		</select>
		<br>
		<label class="text-dark h5">Prioridade:</label>
		<select class='form-control' name="prioridade"><br>
		
			 <?php
				include_once ("classes/funcoessql.php");
				$p = new funcoessql();
				$p->setconsulta("SELECT id_prioridadae, desc_prioridade FROM prioridade");
				
				
				if( $p->total() > 0 ):
					foreach( $p->ler() AS $ps ):
						echo "<option value=".$ps['id_prioridadae'].">" .$ps['desc_prioridade']."</option>";
					endforeach;
				endif;
			 ?>
		</select>                                        
</div>  
<div class="modal-footer">
	<button type="button" class="btn btn-success btn-sm" data-dismiss="modal">Voltar</button>
	<button type="submit" name=addchamado class="btn btn-warning btn-sm">Inserir</button>
</div>	   
</form>
       
    </div>
  </div>
</div>

<!-- MODAL SAIR COM A PERGUNTA-->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
	  <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"><?php echo isset( $_SESSION['nome_user'] ) ?$_SESSION['nome_user'] : ""; ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
	  <div class="modal-body">
        Deseja realmente sair?
      </div>
      <div class="modal-footer">
	   
        <button type="button" class="btn btn-success btn-sm" data-bs-dismiss="modal">Não</button>
		<form method=post action=sair.php>
        <button type="submit" name=sair class="btn btn-warning btn-sm">Sim</button>
		</form>
		
      </div>
    </div>
  </div>
</div>


<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.108.0">
    <title>Carousel Template · Bootstrap v5.3</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/carousel/">


<link href="css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="css/carousel.css" rel="stylesheet">
  </head>
  <body>
    
<header>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
        
		<!-- Botão Sair ativa o modal -->
        <button type="button" class="btn btn-outline-danger me-3 btn-sm" 
		data-bs-toggle="modal" data-bs-target="#staticBackdrop">
		<?php echo isset( $_SESSION['nome_user'] ) ?$_SESSION['nome_user'] : ""; ?>
		</button>
		
		<!-- Botão Incluir chamado -->

		
			<button type="button" class="btn btn-outline-success me-3 btn-sm" 
			data-toggle="modal" data-target=".bd-example-modal-lg">ABRIR CHAMADO</button>
		
	
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
		data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" 
		aria-label="Toggle navigation">
          
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav me-auto lead">

                  <?php
                  include_once("classes/funcoessql.php");
                  $menu = new funcoessql();
                  $menu->setconsulta('select * from categoria');
                  if( $menu->total() > 0 )
                  {
                      foreach($menu->ler() as $m):
                          echo "<li class='nav-item'>
                              <a class='nav-link active' aria-current='page' href='?pag=inicio&idcat=".$m['id_categoria']."'>".$m['desc_categoria']."</a>
                                         </li>";
                      endforeach;
                  } 
                  ?>
          </ul>
          <form method=post action='?pag=busca' class="d-flex my-2" role="search">
            <input class="form-control me-4" name=chave minlength=3 type="search" 
			placeholder="Buscar" aria-label="Search">
            <button class="btn btn-outline-success me-3 lead btn-sm" type="submit">BUSCAR</button>
          </form>
		  
        </div>
    </div>
  </nav>
</header>
<br>