<?php

include_once("../classes/funcoessql.php");

//fazer update no formulário do modal

if(isset($_POST['altsts']))
{
	if(!empty($_POST['descsts']))
	{
		$ids   = $_POST['idsts'];
		$desc  = $_POST['descsts'];
		
		$alt = new funcoessql();
		$alt->setconsulta("update status set desc_status = '$desc' where id_status=$ids");
		
		
		if(!empty($_POST['descsts']))
		{
			if($alt->alterar() > -1 );
			{
				header('Location: http://localhost/helpdesk/adm/index.php?pg=status');
			}			
		}			
	}
}

//Excluir

if(isset($_POST['excsts']))
{
	if(!empty($_POST['idsts']))
	{
		$idsts = $_POST['idsts'];
		
		
		
		$exc = new funcoessql();
		
		$exc->setconsulta("delete from status where id_status = $idsts");
		
		if($exc->excluir() > -1)
		{
			
			header('Location: http://localhost/helpdesk/adm/index.php?pg=status');
		}
	}
}

//Tratar inserção

if(isset($_POST['inssts']))
{
	if(!empty($_POST['descsts']))
	{
		
		
		$descricao = $_POST['descsts'];
		
		
		$ins = new funcoessql();
		$ins->setconsulta("insert into status values(null, '$descricao')");
		
		if($ins->inserir() > -1)
		{
			header('Location: http://localhost/helpdesk/adm/index.php?pg=status');
		}
		
	}
}

?>