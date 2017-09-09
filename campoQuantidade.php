<?php
	session_start();
	$carrinho = $_SESSION['carrinho'];
	$botao = $_GET['botao'];
	$id = $_GET['id'];
	for($i=0;$i < count($carrinho);$i++){
		if($carrinho[$i][0] == $id){
			if($botao == "menos" && $carrinho[$i][1] > 1){
				$carrinho[$i][1] = $carrinho[$i][1] - 1;
				$_SESSION['carrinho'] = $carrinho;
				header("Location:carrinho.php?#$id");
				break;
			}
			else if($botao == "mais" && $carrinho[$i][1] >= 1){
				$carrinho[$i][1] = $carrinho[$i][1] + 1;
				$_SESSION['carrinho'] = $carrinho;
				header("Location:carrinho.php?");
				break;
			}
			else{
				header("Location:deleteProdutoCarrinho.php?id=$id");
			}
		}
	}

?>