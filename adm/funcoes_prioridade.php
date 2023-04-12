<?php

include_once("../classes/funcoessql.php");

//fazer update no formulário do modal

if(isset($_POST['altprio']))
{
	if(!empty($_POST['descprio']))
	{
		$idp   = $_POST['idprio'];
		$desc  = $_POST['descprio'];
		
		$alt = new funcoessql();
		$alt->setconsulta("update prioridade set desc_prioridade = '$desc' where id_prioridadae=$idp");
		
		
		if(!empty($_POST['descprio']))
		{
			if($alt->alterar() > -1 );
			{
				header('Location: http://localhost/helpdesk/adm/index.php?pg=prioridade');
			}			
		}			
	}
}

//Excluir

if(isset($_POST['excprio']))
{
	if(!empty($_POST['idprio']))
	{
		$idprio = $_POST['idprio'];
		
		
		
		$exc = new funcoessql();
		
		$exc->setconsulta("delete from prioridade where id_prioridadae = $idprio");
		
		if($exc->excluir() > -1)
		{
			
				header('Location: http://localhost/helpdesk/adm/index.php?pg=prioridade');
		}
	}
}

//Tratar inserção

if(isset($_POST['insprio']))
{
	if(!empty($_POST['descprio']))
	{
		
		
		$descricao = $_POST['descprio'];
		
		
		$ins = new funcoessql();
		$ins->setconsulta("insert into prioridade values(null, '$descricao')");
		
		if($ins->inserir() > -1)
		{
			header('Location: http://localhost/helpdesk/adm/index.php?pg=prioridade');
		}
		
	}
}

?>