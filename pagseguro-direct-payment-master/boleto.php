<?php 
    require_once('config.php');
    require_once('utils.php');
?>

<html>
<head>
    <meta charset="UTF-8">
</head>
<?php 
	session_start();
	$array_compra = $_SESSION['compra']; 
	if($array_compra[2][0] == '40010'){
		$frete = 2;
	}
	else if($array_compra[2][0] == '41106'){
		$frete = 1;
	}
    $params = array(
        'email'                     => $PAGSEGURO_EMAIL,  
        'token'                     => $PAGSEGURO_TOKEN,
        'receiverEmail'             => $PAGSEGURO_EMAIL,
        'paymentMode'               => 'default', 
        'paymentMethod'             => 'creditCard', 
        'currency'                  => 'BRL',
        'reference'                 => 'REF1234',
        'senderName'                => $array_compra[1][1],
        'senderCPF'                 => $array_compra[1][8],
        'senderAreaCode'            => $array_compra[1][6],
        'senderPhone'               => $array_compra[1][7],
        'senderEmail'               => $array_compra[1][0],
        'shippingAddressStreet'     => $array_compra[1][2],
        'shippingAddressNumber'     => $array_compra[1][3],
        'shippingAddressDistrict'   => $array_compra[1][9],
        'shippingAddressPostalCode' => $array_compra[1][5],
        'shippingAddressCity'       => $array_compra[1][4],
        'shippingAddressState'      => $array_compra[1][10],
        'shippingAddressCountry'    => 'BRA',
        'shippingType'              => $frete,
        'shippingCost'              => $array_compra[2][1]
    );
	for($i=0;$i < count($array_compra[0]); $i++){	
		$cont = $i + 1;
		$itemId = 'itemId' . (string) $cont;
		$itemDescription = 'itemDescription' . (string) $cont;
		$itemAmount = 'itemAmount' . (string) $cont;
		$itemQuantity = 'itemQuantity' . (string) $cont;
		$params[$itemId] = $array_compra[0][$i][0];
		$params[$itemDescription] = $array_compra[0][$i][2];
		$params[$itemAmount] = $array_compra[0][$i][3];
		$params[$itemQuantity] = $array_compra[0][$i][1];
	}
?>
<body>
    <h1>Pagseguro Test</h1>
</body>
</html>