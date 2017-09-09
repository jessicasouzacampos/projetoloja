<?php
	session_start();
	if(!isset($_SESSION['carrinho'])){
		$array_carrinho = array();
		$_SESSION['carrinho'] = $array_carrinho;
	}
	else{
		$array_carrinho = $_SESSION['carrinho'];
	}
?>