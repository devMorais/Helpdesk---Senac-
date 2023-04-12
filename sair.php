<?php 
session_start();
session_destroy();

echo "<script>
	    window.location.replace('http://localhost/helpdesk/login.php');
      </script>";


?>