<?php 
if(isset($_GET['pg']))
{
	$pg = $_GET['pg'];
}else{
	$pg = "";
}

//$pg = isset($_GET['pg']) ? $_GET['pg'] : "";

 switch($pg)
 {      
	case 'categoria':
		include_once ("manter_categoria.php");
    break;
	
	case 'status':
		include_once ("manter_status.php");
    break;
	
	case 'prioridade':
		include_once ("manter_prioridade.php");
    break;
	
	case 'tipousuario':
		include_once ("manter_tipousuario.php");
    break;
	
	case 'usuario':
		include_once ("manter_usuario.php");
    break;
	
 }			
		
?>