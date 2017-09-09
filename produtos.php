<?php
	require_once("session_carrinho.php");
	require_once("conexao.php");
	require_once("template/Template.php");
    use raelgc\view\Template;
	
    $tpl = new Template("produtos.html");
	$tpl->QTCARRINHO = count($_SESSION['carrinho']);
	if(isset($_GET['categoria'])){
		$categoria = $_GET['categoria'];
		$query = "SELECT * FROM produtos WHERE categoria = '$categoria'";
		$tpl->CATEGORIA = ucfirst($_GET['categoria']);
	}
	else if(isset($_POST["pesquisa"])){
		$pesquisa = $_POST["pesquisa"];
		$tpl->CATEGORIA = 'Resultados para "' . $pesquisa . '"';
		$query = "SELECT * FROM produtos WHERE nome LIKE '%".$pesquisa."%' ORDER BY nome";
	}
	else{
		$tpl->CATEGORIA = 'Produtos variados';
		$query = "SELECT * FROM produtos";
		
	}
	$result = $mysqli->query($query);
	if($result->num_rows <= 0){
		$tpl->NADA_ENCONTRADO = 'Nenhum produto foi encontrado.';
		$tpl->block("BLOCK_NADAENCONTRADO");
	}
	else{
		while($linha = $result->fetch_array(MYSQLI_NUM)){
			$tpl->ID = $linha[0];
			$tpl->NOME = $linha[1];
			$tpl->PRECO = number_format($linha[2] , 2 , ',' , '');
			$tpl->IMAGEM = $linha[3];
			$tpl->block("BLOCK_PRODUTO");
		}
	}

    $tpl->show();
?>