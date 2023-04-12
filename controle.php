<?php 
if(isset($_GET['pag']))
{
	$pagina = $_GET['pag'];
}else{
	$pagina = "";
}

//$pagina = isset($_GET['pag']) ? $_GET['pag'] : "";

 switch( $pagina ):
        case 'busca':
            include_once ("busca.php");
            break;
        case 'detalhes':
            include_once ("detalhes.php");
            break;
        case 'inicio':
            include_once ("inicial.php");
            break;
        default:
            include_once ("inicial.php");           
            break;
    endswitch;

?>