<?php

session_start();

$user = $_SESSION['id_user'];

include_once("classes/funcoessql.php");

            if( isset($_POST['addchamado']))
			{
                if( !empty($_POST['assuntoChamado']) && !empty($_POST['descricao']) && 
					!empty($_POST['categoria']) && !empty($_POST['prioridade']) )
					
				{
                    
                    $fk_cat = $_POST['categoria'];
                    $user = $_SESSION['id_user'];
                    $fk_prior = $_POST['prioridade'];
                    $assunto = $_POST['assuntoChamado'];
                    $descricao = $_POST['descricao'];

                    $insere = new funcoessql();
                    $insere->setconsulta("INSERT INTO chamado VALUES(null,$fk_cat, $user, 1, $fk_prior, NOW(), '$assunto', '$descricao')");

                    if( $insere->inserir() > -1 )
					{
                        
						
						echo "<script>
								alert('Inserido com sucesso')
								window.location.href = 'http://localhost/helpdesk/index.php?pag=inicio&idcat=$fk_cat'
							  </script>";
                    }
               
                }
            }
?>
