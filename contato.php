<?php
	require_once("session_carrinho.php");	
	require_once("conexao.php");
	require_once("template/Template.php");
    use raelgc\view\Template;
	
    $tpl = new Template("contato.html");
	$tpl->QTCARRINHO = count($_SESSION['carrinho']);
    $tpl->show();
?>