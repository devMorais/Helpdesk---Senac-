<?php
session_start();

$user = $_SESSION['id_user'];
$ncont = 0;
if(isset($_GET['id']))
{
	$id = $_GET['id'];
}else{
	$id = 0;
}
include_once("classes/funcoessql.php");

//TRATA ALTERAÇÃO DE CATEGORIA=STATUS=PRIORIDADE
if(isset($_POST['atualizar']))
{
	$cat_atual     = $_POST['cat_atual'];
	$st_atual      = $_POST['st_atual'];
	$pri_atual     = $_POST['pri_atual'];
	$newcategoria  = $_POST['newcategoria'];
	$newstatus     = $_POST['newstatus'];
	$newprioridade = $_POST['newprioridade'];
	//atualizar chamado
	if( $cat_atual != $newcategoria || $st_atual != $newstatus || $pri_atual  != $newprioridade)
	{
		$atu = new funcoessql();
		$atu->setconsulta("update chamado set fk_categoria = $newcategoria, fk_status = $newstatus, fk_prioridadae = $newprioridade where id_chamado = $id ");
		if($atu->alterar() > -1)
		{
		   $ncont++;	
		   
		}
		
	}
	
	if($st_atual != $newstatus)
	{
		$ins = new funcoessql();
		$ins->setconsulta("insert into logstatus values(null,now(),$user,$st_atual,$newstatus,$id )");
		
		if($ins->inserir() > -1)
		{
			$ncont++;	
		}
	}
	
	if($ncont == 0){
		echo "<script>
						alert('Nada foi alterado')
						window.location.href = 'http://localhost/helpdesk/index.php?pag=detalhes&id_chamado=".$id."#detalhes'
					  </script>";
		
	}else{
		echo "<script>
						window.location.href = 'http://localhost/helpdesk/index.php?pag=detalhes&id_chamado=".$id."#detalhes'
					  </script>";
	}
	
}
//TRATA COMENTARIOS

if(isset($_POST['enviar']))
{
	if(!empty($_POST['text']))
	{
	    $usuario   = $_SESSION['id_user'];
		$idchamado = $_GET['id'];
		$com       = $_POST['text'];
	    $comment   = new funcoessql();
		$comment->setconsulta("insert into comentario values(null, now(), $usuario, $idchamado,'$com')");
		
		if($comment->inserir() > -1)
		{
				echo "<script>
						alert('Comentário incluido com sucesso')
						window.location.href = 'http://localhost/helpdesk/index.php?pag=detalhes&id_chamado=".$id."&id_comentario=null#comentario'
					  </script>";
		}

	}
}
//TRATA ANEXOS
if(isset($_POST['envarq']))
{
	if(!empty($_FILES['arquivo']['name']) && isset($_FILES['arquivo']['name']))
	{ 
        include_once("classes/recebe.php"); 
		$nomearq = gravar();
		$idu = $_SESSION['id_user'];
		$arq = new funcoessql();
		$arq->setconsulta("insert into arquivo values(null,'$nomearq',now(), $id, $idu)");
		
		if(!empty($nomearq))
		{
			if($arq->inserir() > -1)
			{
				echo "<script>
							alert('Arquivo incluido com sucesso')
							window.location.href = 'http://localhost/helpdesk/index.php?pag=detalhes&id_chamado=".$id."#anexo'
						  </script>";
		
			}
		}else{
			echo "<script>
							alert('Erro ao subir arquivo')
							window.location.href = 'http://localhost/helpdesk/index.php?pag=detalhes&id_chamado=".$id."#anexo'
						  </script>";
			
		}
	}
}
?>
 