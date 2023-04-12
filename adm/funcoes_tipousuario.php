<?php

include_once("../classes/funcoessql.php");

//fazer update no formulário do modal

if(isset($_POST['alttu']))
{
	if(!empty($_POST['desctu']))
	{
		$ids   = $_POST['idtu'];
		$desc  = $_POST['desctu'];
		
		$alt = new funcoessql();
		$alt->setconsulta("update tipousuario set desc_tipo = '$desc' where id_tipousuario=$ids");
		
		
		if(!empty($_POST['desctu']))
		{
			if($alt->alterar() > -1 );
			{
				header('Location: http://localhost/helpdesk/adm/index.php?pg=tipousuario');
			}			
		}			
	}
}

//Excluir

if(isset($_POST['exctu']))
{
	if(!empty($_POST['idtu']))
	{
		$idsts = $_POST['idtu'];
		
		
		
		$exc = new funcoessql();
		
		$exc->setconsulta("delete from tipousuario where id_tipousuario = $idsts");
		
		if($exc->excluir() > -1)
		{
			
			header('Location: http://localhost/helpdesk/adm/index.php?pg=tipousuario');
		}
	}
}

//Tratar inserção

if(isset($_POST['instu']))
{
	if(!empty($_POST['desctu']))
	{
		
		$descricao = $_POST['desctu'];
		
		$ins = new funcoessql();
		$ins->setconsulta("insert into tipousuario values(null, '$descricao')");
		
		if($ins->inserir() > -1)
		{
			header('Location: http://localhost/helpdesk/adm/index.php?pg=tipousuario');
		}
		
	}
}

?>