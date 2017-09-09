<?php 
    require_once('config.php');
    require_once('utils.php');
?>
<html>
<head>
    <meta charset="UTF-8">
	<?php 
		session_start();
        $params = array(
            'email' => $PAGSEGURO_EMAIL,
            'token' => $PAGSEGURO_TOKEN
        );
        $header = array();

        $response = curlExec($PAGSEGURO_API_URL."/sessions", $params, $header);
        $json = json_decode(json_encode(simplexml_load_string($response)));
        $sessionCode = $json->id;
    ?>
</head>
<body>
	<form role="form" action="./pay.php" method="POST">
		<input type="hidden" name="brand">
        <input type="hidden" name="token">
        <input type="hidden" name="senderHash">
		<input type="tel" class="form-control" name="cardNumber" placeholder="Valid Card Number" autocomplete="cc-number"  autofocus value="4111 1111 1111 1111"/>
        <input type="tel" class="form-control" name="cardExpiry" placeholder="MM / YY" autocomplete="cc-exp"  value="12/2030"/>
		<input type="tel" class="form-control" name="cardCVC" placeholder="CVV" autocomplete="cc-csc"  value="123"/>
		<label>E-mail</label><br><br>
		<input class='campo100' type="email" name="email"/><br><br>
		<label>Endereço</label><br><br>
		<input class='campo50' type="text" placeholder="Primeiro nome" name="nome"  />
		<input class='campo100' type="text" placeholder="Rua" name="rua"  />
		<input class='campo50' type="text" placeholder="Número" name="numero"  />
		<input class='campo50' type="text" placeholder="Bairro" name="bairro"  />
		<input class='campo33' type="text" name="cep" placeholder="CEP" onKeyPress="MascaraCep(form1.cep);"maxlength="10"  />
		<input class='campo33' type="text" placeholder="Telefone" name="tel" onKeyPress="MascaraTelefone(form1.telefone);" maxlength="15"  />
		<input class='campo33' type="text" placeholder="CPF" name="cpf" onKeyPress="MascaraCPF(form1.cpf);" maxlength="14"  />
		<button class="subscribe btn btn-success btn-lg btn-block" type="submit">Pagar</button>
	</form>
       
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
  <script>

        $("button:submit").click(function(){
            var senderHash = PagSeguroDirectPayment.getSenderHash();
            $("input[name='senderHash']").val(senderHash);
        });

        jQuery(function($) {
          PagSeguroDirectPayment.setSessionId('<?php echo $sessionCode;?>');

          PagSeguroDirectPayment.getPaymentMethods({
            success: function(json){
                console.log(json);
            },
            error: function(json){
                console.log(json);
              var erro = "";
              for(i in json.errors){
                erro = erro + json.errors[i];
              }
              alert(erro);
            },
            complete: function(json){
            }
          });

          PagSeguroDirectPayment.getBrand({
            cardBin: $("input[name='cardNumber']").val().replace(/ /g,''),
            success: function(json){
              var brand = json.brand.name;

              $("input[name='brand']").val(brand);

              console.log(brand);
              
              var param = {
                cardNumber: $("input[name='cardNumber']").val().replace(/ /g,''),
                brand: brand,
                cvv: $("input[name='cardCVC']").val(),
                expirationMonth: $("input[name='cardExpiry']").val().split('/')[0],
                expirationYear: $("input[name='cardExpiry']").val().split('/')[1],
                success: function(json){
                  var token = json.card.token;
                  $("input[name='token']").val(token);
                  console.log("Token: " + token);
                },
                error: function(json){
                    console.log(json);
                },
                complete:function(json){
                }
              }

              PagSeguroDirectPayment.createCardToken(param);
            },
            error: function(json){
              console.log(json);
            },
            complete: function(json){
            }
          });

        });

    </script>
</body>
</html>