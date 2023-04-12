<?php

function gravar()
{	

	$novonome = "";	
	$arq['pasta'] 	= "arquivo/"; // Onde o arquivo será colocado
	$arq['tamanho'] = 1024 * 1024 * 2; // Tamanho máximo permitido no formulário: 2Mb
	$arq['ext'] 	= array('jpeg', 'jpg', 'png', 'gif','pdf'); // Extensões permitidas

	// Mensagens tratando os erros:
	$arq['erros'][0] = "Não houve erro";
	$arq['erros'][1] = "O tamanho do arquivo excedo o definido no PHP";
	$arq['erros'][2] = "O tamanho do arquivo excedo o definido no FORMULÁRIO";
	$arq['erros'][3] = "O upload do arquivo foi feito parcialmente";
	$arq['erros'][4] = "Nenhum arquivo foi enviado";
	$arq['erros'][6] = "Pasta temporária ausente";
	$arq['erros'][7] = "Falha ao escrever o arquivo no disco";
	$arq['erros'][8] = "Uma extensão do PHP interrompeu o upload do arquivo";

	if($_FILES['arquivo']['error'] != 0)
	{
		echo("Não foi possível carregar o arquivo. Motivo: ".$arq['erros'][$_FILES['arquivo']['error']]);

	}

	$tmp = explode(".",$_FILES['arquivo']['name']); // Quebra a string e várias strings e separa em um array
	$extensao = strtolower(end($tmp)); // Está sendo recuperado a extensão do arquivo (end retorna a ultima posição do array e o strtolower deixa tudo minúscula)

	if(array_search($extensao, $arq['ext']) === false)//Verifica o tipo esperado
	{ 
		echo "Extensão submetida inesperada. Extensões suportadas: jpeg, jpg, png, gif";

		
	}elseif($_FILES['arquivo']['size'] > $arq['tamanho']){//Tamanho excede
		
		echo "Tamanho excede o permitido (máximo de 2mb)";


	}else{ //Mover arquivo
		
		$novonome = time().'.'.$extensao;
		if(move_uploaded_file($_FILES['arquivo']['tmp_name'],$arq['pasta'].$novonome))
		{
			echo "Sucesso no upload do arquivo";
			
		}else{
			
			echo "Erro no upload do arquivo";
		}
		
		return $novonome;
	}
}

?>