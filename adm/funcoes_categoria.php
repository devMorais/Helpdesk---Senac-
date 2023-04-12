<?php

include_once("../classes/funcoessql.php");

//fazer update no formulário do modal

if(isset($_POST['altcat']))
{
	if(!empty($_POST['desccat']) || isset($_FILES['arquivo']['name']))
	{
		include_once("../classes/recebe.php");
		
		$idc   = $_POST['idcat'];
		$desc  = $_POST['desccat'];
		$img   = gravar();
		
		
		
		$alt = new funcoessql();
		$alt->setconsulta("update categoria set desc_categoria 		= '$desc', 
												imagem		   		= '$img'	
												where id_categoria	= $idc");
		
		
		if(!empty($_POST['desccat']) || !empty($img) )
		{
			if($alt->alterar() > -1 );
			{
				header('Location: http://localhost/helpdesk/adm/index.php?pg=categoria');
			}			
		}			
	}
}




//Excluir

if(isset($_POST['exccat']))
{
	if(!empty($_POST['idcat']))
	{
		$idcat = $_POST['idcat'];
		
		
		
		$exc = new funcoessql();
		
		$exc->setconsulta("delete from categoria where id_categoria = $idcat");
		
		if($exc->excluir() > -1)
		{
			
			header('Location: http://localhost/helpdesk/adm/index.php?pg=categoria');
		}
	}
}

//Tratar inserção

if(isset($_POST['inscat']))
{
	if(!empty($_POST['desccat']))
	{
		
		include_once("../classes/recebe.php");
		
		$descricao = $_POST['desccat'];
		$imagem    = gravar();
		
		$ins = new funcoessql();
		$ins->setconsulta("insert into categoria values(null, '$descricao','$imagem')");
		
		if($ins->inserir() > -1)
		{
			header('Location: http://localhost/helpdesk/adm/index.php?pg=categoria');
		}
		
	}
}

?>