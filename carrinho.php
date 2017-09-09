<?php
	require_once("session_carrinho.php");
	require_once("conexao.php");
	require_once("template/Template.php");
    use raelgc\view\Template;
    $tpl = new Template("carrinho.html");
	$tpl->QTCARRINHO = count($_SESSION['carrinho']);
	if(count($_SESSION['carrinho'])==0 || !isset($_SESSION['carrinho'])){
		$tpl->block("BLOCK_CARTEMPTY");
	}
	else{
		$subtotal = 0;
		for($i=0;$i < count($array_carrinho); $i++){
			$t = $array_carrinho[$i][0];
			$query = "SELECT * FROM produtos WHERE id = $t";
			$result = $mysqli->query($query);
			while($listar = $result->fetch_array()){
				$tpl->ID = $listar[0];
				$tpl->NOME = strtoupper($listar[1]);
				$tpl->IMAGEM = $listar[3];
				$preco = $listar[2];
				$tpl->QUANTIDADE = $array_carrinho[$i][1];
				$total_produto = $listar[2] * $array_carrinho[$i][1];
				$subtotal = $subtotal + $total_produto;
				$tpl->TOTAL_PRODUTO = number_format($total_produto , 2 , ',' , '');
			}
			$tpl->block("BLOCK_PRODUTOCARRINHO");	
		}
		$tpl->SUBTOTAL = number_format($subtotal , 2 , ',' , '');
		$tpl->block("BLOCK_CARTNOTEMPTY");
	}
    $tpl->show();
?>