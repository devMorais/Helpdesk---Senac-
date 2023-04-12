<?php 
   session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.108.0">
    <title>Sistema de Chamados - Socorro</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sign-in/">

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
    <link href="css/sign-in.css" rel="stylesheet">
  </head>
  <body class="text-center">
    
<main class="form-signin w-100 m-auto lead">
  <form method=post>
    <img class="mb-4" src="img/bootstrap-logo.svg" alt="" width="72" height="57">
   <!-- <h1 class="h3 mb-3 fw-normal">Informe suas crendenciais</h1> -->

    <div class="form-floating">
      <input type="email"  class="form-control" name="usuario" placeholder="name@example.com">
      <label for="floatingInput">Email</label>
    </div>
    <div class="form-floating">
      <input type="password"  class="form-control" name="senha" placeholder="Password">
      <label for="floatingPassword">Senha</label>
    </div>

    <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="remember-me"> Lembrar?
      </label>
    </div>
    <button class="w-100 btn btn-lg btn-success" type="submit" name=logar>Entrar</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2022–2025</p>
  </form>
</main>
   
</body>
</html>
<?php
if(isset($_POST['logar']))
{
	$usuario = $_POST['usuario'];
	$senha   = $_POST['senha'];
	
	if(!empty($usuario) and !empty($senha))
	{
		include_once("classes/funcoessql.php");
		$login = new funcoessql();
		$login->setconsulta("select id_usuario, nome, upper(desc_tipo) tipo_user from usuario, tipousuario where email='$usuario' and senha = '$senha' and id_tipousuario = fk_tipousuario");
		if($login->total() == 1)
		{
			foreach($login->ler() as $l)
			{
			   $_SESSION['id_user']   = $l['id_usuario'];
			   $_SESSION['nome_user'] = $l['nome'];
			   $_SESSION['logado']    = 'Sim';
			   $_SESSION['desc_tipo'] = $l['tipo_user'];
			   
			   if($l['tipo_user']=="ADMINISTRADOR")
			   {
				 
			   echo "<script>
		           	   window.location.replace('adm/index.php');
			         </script>";
			   }else{
				   echo "<script>
		           	   window.location.replace('index.php');
			         </script>";
					
			   }
			   
			}
			
		}else{
			echo "<script>
			
				 alert('Dados incorretos!');
				 window.location.replace('index.php');
			
				</script>";
		}
		
	}
	
}


?>












