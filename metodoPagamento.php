<?php
	require_once("session_carrinho.php");
	require_once("conexao.php");
	
	require_once("template/Template.php");
    use raelgc\view\Template;
	$tpl = new Template("metodoPagamento.html");
	
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
	
	if($_POST['frete'] == 'sedex'){
		$tipoFrete = $_SESSION['frete'][0];
		$freteTotal = $_SESSION['frete'][0][1];
	}
	else{
		$tipoFrete = $_SESSION['frete'][1];
		$freteTotal = $_SESSION['frete'][1][1];
	}
	$tpl->FRETETOTAL = $freteTotal;
	$freteTotal2 = str_replace(',','.',$freteTotal);
	$freteNumber = (float) $freteTotal2;
	$totalFinal = $freteNumber + $somaValores;
	$tpl->TOTALFINAL = number_format($totalFinal , 2 , ',' , '');
	$_SESSION['compra'][2] = $tipoFrete;
	
    $tpl->show();
?>