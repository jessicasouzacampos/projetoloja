<?php
	session_start();
	$idProduto = $_GET['id'];
	$carrinho = $_SESSION['carrinho'];
	for($i=0;$i < count($carrinho); $i++){
		if($carrinho[$i][0] == $idProduto){
			unset($carrinho[$i]);
			break;
		}
	}
	print_r($carrinho);
	array_multisort($carrinho);
	$_SESSION['carrinho'] = $carrinho;
	header('Location:carrinho.php');
?>