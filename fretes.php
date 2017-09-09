<?php
$data['nCdEmpresa'] = '';
 $data['sDsSenha'] = '';
 $data['sCepOrigem'] = '35560000';
 $data['sCepDestino'] = $cepClean;
 $data['nVlPeso'] = '1';
 $data['nCdFormato'] = '1';
 $data['nVlComprimento'] = '16';
 $data['nVlAltura'] = '5';
 $data['nVlLargura'] = '15';
 $data['nVlDiametro'] = '0';
 $data['sCdMaoPropria'] = 's';
 $data['nVlValorDeclarado'] = '200';
 $data['sCdAvisoRecebimento'] = 'n';
 $data['StrRetorno'] = 'xml';
 $data['nCdServico'] = '40010,41106';
 $data = http_build_query($data);

 $url = 'http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx';

 $curl = curl_init($url . '?' . $data);
 curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

 $result = curl_exec($curl);
 $result = simplexml_load_string($result);
 $array_frete = array();
 $contador = 0;
 foreach($result -> cServico as $row) {
 //Os dados de cada serviço estará aqui
 if($row -> Erro == 0) {
     $array_frete[$contador][0] = (string)$row -> Codigo;
	 $array_frete[$contador][1] = (string)$row -> Valor;
     $array_frete[$contador][2] = (string)$row -> PrazoEntrega;
	 $array_frete[$contador][3] = (string)$row -> ValorMaoPropria;
	 $array_frete[$contador][4] = (string)$row -> ValorAvisoRecebimento;
	 $array_frete[$contador][5] = (string)$row -> ValorValorDeclarado;
	 $array_frete[$contador][6] = (string)$row -> EntregaDomiciliar;
	 $array_frete[$contador][7] = (string)$row -> EntregaSabado;
	 $contador++;
 } else {
     echo $row -> MsgErro;
 }
 }
  $_SESSION['frete'] = $array_frete;
?>