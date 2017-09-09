<?php
	require_once("session_carrinho.php");
	require_once("conexao.php");
	
	$cepClean = sanitizeString($_POST['cep']);
	require_once("fretes.php");
	
	require_once("template/Template.php");
    use raelgc\view\Template;
	$tpl = new Template("frete.html");
	
	function sanitizeString($string) {
		$what = array( '.','ä','ã','à','á','â','ê','ë','è','é','ï','ì','í','ö','õ','ò','ó','ô','ü','ù','ú','û','À','Á','É','Í','Ó','Ú','ñ','Ñ','ç','Ç',' ','-','(',')',',',';',':','|','!','"','#','$','%','&','/','=','?','~','^','>','<','ª','º' );
		$by   = array( '' ,'a','a','a','a','a','e','e','e','e','i','i','i','o','o','o','o','o','u','u','u','u','A','A','E','I','O','U','n','n','c','C','_' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' );
		return str_replace($what, $by, $string);
	}

	$totalValores = array();
	for($i=0;$i < count($array_carrinho); $i++){
		
		$idProduto = $array_carrinho[$i][0];
		$qtProduto = $array_carrinho[$i][1];
		$nomeProduto = $array_carrinho[$i][2];
		$precoProduto = $array_carrinho[$i][3];
		$imagemProduto = $array_carrinho[$i][4];
		$totalDoProdutoMostrar = $precoProduto * $qtProduto;
		$totalValores[] = $totalDoProdutoMostrar;
		$tpl->IMAGEM = $imagemProduto;
		$tpl->QT = $qtProduto;
		$tpl->NOME = $nomeProduto;
		$tpl->TOTALDOPRODUTO = number_format($totalDoProdutoMostrar , 2 , ',' , '');
		
		$tpl->block("BLOCK_PRODUTOCARRINHO");	
	}
	$somaValores = array_sum($totalValores);
	$tpl->TOTALVALORES = number_format($somaValores , 2 , ',' , '');
	
	$nomeClean = sanitizeString($_POST['nome']);
	$sobrenomeClean = sanitizeString($_POST['sobrenome']);
	$nomeCompleto = $nomeClean . " " . $sobrenomeClean;
	$bairroClean = sanitizeString($_POST['bairro']);
	$estadoClean = sanitizeString($_POST['estado']);
	$explode = explode(")",$_POST['telefone']);
	$dddClean = sanitizeString($explode[0]);
	$telClean = sanitizeString($explode[1]);
	$cpfClean = sanitizeString($_POST['cpf']);
	$frete = $_SESSION['frete'];
	$tpl->PAC = $frete[1][1];
	$tpl->PRAZO_PAC = $frete[1][2];
	$tpl->SEDEX = $frete[0][1];
	$tpl->PRAZO_SEDEX = $frete[0][2];
	$checkoutCliente = array($_POST['email'],$nomeCompleto,$_POST['rua'],$_POST['numero'],$_POST['cidade'],str_replace('_','',$cepClean),str_replace('_','',$dddClean),str_replace('_','',$telClean),str_replace('_','',$cpfClean),str_replace('_','',$bairroClean),str_replace('_','',$estadoClean));
	$_SESSION['compra'][1] = $checkoutCliente;
	
    $tpl->show();
?>