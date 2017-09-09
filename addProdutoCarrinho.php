<?php
	session_start();
	$idProduto = $_POST['id'];
	$nomeProduto = $_POST['nome'];
	$precoProduto = (double) $_POST['preco'];
	$imagemProduto = $_POST['imagem'];
	$qtProduto = 1;
	$arrayProduto = array($idProduto,$qtProduto,$nomeProduto,$precoProduto,$imagemProduto);
	if(!isset($_SESSION['carrinho'])){
		$array_carrinho = array($arrayProduto);
		$_SESSION['carrinho'] = $array_carrinho;
	}
	else{
		$array_carrinho = $_SESSION['carrinho'];
		for($i=0;$i < count($array_carrinho);$i++){
			if($array_carrinho[$i][0] == $idProduto){
				$array_carrinho[$i][1] = $array_carrinho[$i][1] + 1;
				$achou = 1;
				break;
			}
		}
		if(!isset($achou)){
			$array_carrinho[count($array_carrinho)] = $arrayProduto;
		}
		$_SESSION['carrinho'] = $array_carrinho;
	}
	header("Location:carrinho.php");
?>