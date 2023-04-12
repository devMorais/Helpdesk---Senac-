<?php
class conexao{

private $endereco     = "localhost";
private $usuario      = "root";
private $senha        = "senac";
private $bancodedados = "helpdesk";
private $con;

function __construct(){
	
   $this->conectar();
	
}
function conectar(){
	
	$con = mysqli_connect($this->endereco,$this->usuario,$this->senha, $this->bancodedados);
	
	return $con;
}	








	
}
?>