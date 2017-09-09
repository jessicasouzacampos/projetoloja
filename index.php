<?php
	require_once("template/Template.php");
	require_once("session_carrinho.php");
    use raelgc\view\Template;
    $tpl = new Template("index.html");
	if(isset($_SESSION['carrinho'])){
		$tpl->QTCARRINHO = count($_SESSION['carrinho']);
	}
	else{
		$_SESSION['carrinho'] = array();
		$tpl->QTCARRINHO = count($_SESSION['carrinho']);
	}
    $tpl->show();
?>