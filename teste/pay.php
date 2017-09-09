<?php 
	session_start();
    require_once('config.php');
    require_once('utils.php');
?>

<html>
<head>
    <meta charset="UTF-8">
</head>
<?php 
    
    $creditCardToken = htmlspecialchars($_POST["token"]);
    $senderHash = htmlspecialchars($_POST["senderHash"]);
	if($creditCardToken != ""){
		echo $PAGSEGURO_EMAIL . "<br>";
		echo $PAGSEGURO_TOKEN . "<br>";
		echo $creditCardToken . "<br>";
		echo $senderHash;
	}
	else{
		echo "vazio";
	}
	$nomeAtualizado = str_replace('_',' ',$_POST['nome']);
	$ruaAtualizado = str_replace('_',' ',$_POST['rua']);
	$telAtualizado = str_replace('_','',$_POST['tel']);
	$dddAtualizado = str_replace('_',' ',$_POST['ddd']);
	$numeroAtualizado = str_replace('_',' ',$_POST['numero']);
	$bairroAtualizado = str_replace('_',' ',$_POST['bairro']);
	$cidadeAtualizado = str_replace('_',' ',$_POST['cidade']);
	$cepAtualizado = str_replace('_',' ',$_POST['cep']);
    $params = array(
        'email'                     => $PAGSEGURO_EMAIL,  
        'token'                     => $PAGSEGURO_TOKEN,
        'creditCardToken'           => $creditCardToken,
        'senderHash'                => $senderHash,
        'receiverEmail'             => $PAGSEGURO_EMAIL,
        'paymentMode'               => 'default', 
        'paymentMethod'             => 'creditCard', 
        'currency'                  => 'BRL',
        // 'extraAmount'               => '1.00',
        'itemId1'                   => '0001',
        'itemDescription1'          => 'PHP Test',  
        'itemAmount1'               => '100.00',  
        'itemQuantity1'             => 1,
        'reference'                 => 'REF1234',
        'senderName'                => $nomeAtualizado,
        'senderCPF'                 => $_POST['cpf'],
        'senderAreaCode'            => $dddAtualizado,
        'senderPhone'               => $telAtualizado,
        'senderEmail'               => $_POST['email'],
        'shippingAddressStreet'     => $ruaAtualizado,
        'shippingAddressNumber'     => $numeroAtualizado,
        'shippingAddressDistrict'   => $bairroAtualizado,
        'shippingAddressPostalCode' => $cepAtualizado,
        'shippingAddressCity'       => $cidadeAtualizado,
        'shippingAddressState'      => $_POST['estado'],
        'shippingAddressCountry'    => 'BRA',
        'shippingType'              => 1,
        'shippingCost'              => '1.00',
        'installmentQuantity'       => 1,
        'installmentValue'          => '101.00',
        'creditCardHolderName'      => 'Chuck Norris',
        'creditCardHolderCPF'       => '54793120652',
        'creditCardHolderBirthDate' => '01/01/1990',
        'creditCardHolderAreaCode'  => 83,
        'creditCardHolderPhone'     => '999999999',
        'billingAddressStreet'     => 'Address',
        'billingAddressNumber'     => '1234',
        'billingAddressDistrict'   => 'Bairro',
        'billingAddressPostalCode' => '58075000',
        'billingAddressCity'       => 'João Pessoa',
        'billingAddressState'      => 'PB',
        'billingAddressCountry'    => 'BRA'
    );
    $header = array('Content-Type' => 'application/json; charset=UTF-8;');
    $response = curlExec($PAGSEGURO_API_URL."/transactions", $params, $header);
    $json = json_decode(json_encode(simplexml_load_string($response)));
?>
<body>
    <h1>Pagseguro Test</h1>
    <h3>Code: <?php echo $json->code;?></h3>
    <h3>Status: <?php echo $json->status;?></h3>
    <p>Response: <?php print_r($json);  ?></p>
</body>
</html>