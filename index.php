 <?php 
 if(isset($_GET['pag']))
{
	$pagina = $_GET['pag'];
}else{
	$pagina = "";
}

	include_once("topo.php");
	include_once("controle.php");
	include_once("rodape.php");

 ?>