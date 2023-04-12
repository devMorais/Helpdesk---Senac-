<?php

include_once("conexao.php");


class funcoessql extends conexao{
	
	private $qry;
	private $consulta;
	private $ret;
	private $l;
	private $total;
	private $la;
	
	function setconsulta($c)
	{
		$this->consulta = $c;
	}
	
	function getconsulta(){
		
		return $this->consulta;
	}
	
	function total(){
		$qry = mysqli_query($this->conectar(), $this->getconsulta());
		$this->total = mysqli_num_rows($qry);
		return $this->total;
	}
	
	function ler(){
		
		$qry = mysqli_query($this->conectar(), $this->getconsulta());
		while($l = mysqli_fetch_array($qry))
		{
			$this->ret[] = $l;
		}
		return $this->ret;
		
	}
	function alterar(){
	   $qry = mysqli_query($this->conectar(), $this->getconsulta());	
	   $this->la = mysqli_affected_rows($this->conectar());
	   return $this->la;
		
	}
	function excluir(){
	   $qry = mysqli_query($this->conectar(), $this->getconsulta());	
	   $this->la = mysqli_affected_rows($this->conectar());
	   return $this->la;	
	}
	function inserir(){
	   $qry = mysqli_query($this->conectar(), $this->getconsulta());	
	   $this->la = mysqli_affected_rows($this->conectar());
	   return $this->la;
	}

}



?>