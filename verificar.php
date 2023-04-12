<?php 
if(!isset($_SESSION['logado']))
{
	echo "<script>
	     window.location.replace('http://localhost/helpdesk/login.php');
		  </script>";
}

?>