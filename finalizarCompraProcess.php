<?php
	session_start();
	$metodo = $_POST['metodo'];
	$_SESSION['compra'][3] = $metodo;
	if($metodo == 'cartao'){
		header("Location:cartaoDeCredito.php");
	}
	else if($metodo == 'boleto'){
		header("Location:boleto.php");
	}
?>