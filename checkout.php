<?php
	require_once("session_carrinho.php");
	require_once("conexao.php");
	
	require_once("template/Template.php");
	use raelgc\view\Template;
	$tpl = new Template("checkout.html");
	
	$_SESSION['compra'] = array($array_carrinho);
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
	
	$tpl->show();
?>