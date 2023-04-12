<?php

include_once("../classes/funcoessql.php");

//fazer update no formulário do modal

if(isset($_POST['altusuario']))
{
	if(!empty($_POST['idusu']) && !empty($_POST['nomeusuario']) && 
									!empty($_POST['email']) && 
									!empty($_POST['senha']) && 
									!empty($_POST['tipousuario'])   &&
									!empty($_POST['cel']))
	{
		$idu         = $_POST['idusu'];	
		$nomeusuario = $_POST['nomeusuario'];
		$email = $_POST['email'];
		$senha = $_POST['senha'];
		$fkusuario = $_POST['tipousuario'];
		$celular = $_POST['cel'];	
		
		$alt = new funcoessql();
		$alt->setconsulta("update usuario set nome 			 = '$nomeusuario',
											email 			 = '$email', 
											senha 			 = '$senha', 
											fk_tipousuario   = $fkusuario, 
											celular 		 = '$celular'
											where id_usuario = $idu");

					
			if($alt->alterar() > -1 );
			{
				header('Location: http://localhost/helpdesk/adm/index.php?pg=usuario');
				exit();
			}			
					
	}
}

//Excluir

if(isset($_POST['excusu']))
{
	if(!empty($_POST['idusu']))
	{
		$idusuario = $_POST['idusu'];
		
		
		
		$exc = new funcoessql();
		
		$exc->setconsulta("delete from usuario where id_usuario = $idusuario");
		
		if($exc->excluir() > -1)
		{
			
				header('Location: http://localhost/helpdesk/adm/index.php?pg=usuario');
				exit();
		}
	}
}

//Tratar inserção

if(isset($_POST['insusu'])) {
	if(!empty($_POST['nomeusu']) && !empty($_POST['email']) && !empty($_POST['senha']) && !empty($_POST['tipousuario']) && !empty($_POST['cel'])) {
		$nomeusuario = $_POST['nomeusu'];
		$email = $_POST['email'];
		$senha = $_POST['senha'];
		$tpusuario = $_POST['tipousuario'];
		$celular = $_POST['cel'];
		// objeto tipo funcoessql
		$ins = new funcoessql();
		// string de insert
		$ins->setconsulta("INSERT INTO usuario VALUES (null, '$nomeusuario', '$email', '$senha', $tpusuario, '$celular')");
		
		if($ins->inserir() > -1) {
			header('Location: http://localhost/helpdesk/adm/index.php?pg=usuario');
			exit();
		}
	}
}


?>