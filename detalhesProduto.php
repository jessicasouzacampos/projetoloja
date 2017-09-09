<?php
	require_once("session_carrinho.php");
	require_once("conexao.php");
	require_once("template/Template.php");
    use raelgc\view\Template;
	
    $tpl = new Template("detalhesProduto.html");
	$tpl->QTCARRINHO = count($_SESSION['carrinho']);
	$idProduto = $_GET["id"];
	$query = "SELECT * FROM produtos WHERE id = $idProduto";
	$result = $mysqli->query($query);
	while($linha = $result->fetch_array(MYSQLI_NUM)){
		$tpl->ID = $linha[0];
		$tpl->NOME = $linha[1];
		$tpl->PRECO = number_format($linha[2] , 2 , ',' , '');
		$tpl->IMAGEM = $linha[3];
		$zoom = explode('.',$linha[3]);
		$tpl->IMAGEMZOOM = $zoom[0] . "_zoom." . $zoom[1]; 
	}

    $tpl->show();
?>