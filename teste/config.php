<?php 

    //Config SANDBOX or PRODUCTION environment
    $SANDBOX_ENVIRONMENT = true;
    
    $PAGSEGURO_API_URL = 'https://ws.pagseguro.uol.com.br/v2';
    if($SANDBOX_ENVIRONMENT){
        $PAGSEGURO_API_URL = 'https://ws.sandbox.pagseguro.uol.com.br/v2';
    }

    $PAGSEGURO_EMAIL = 'gabrielscamposs@hotmail.com';
    $PAGSEGURO_TOKEN = '7880D3A912E74D1D9EBF795ACC1B7727';
?>