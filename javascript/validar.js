function TestaCPF(strCPF) {
	strCPF = strCPF.replace("-","");
	strCPF = strCPF.replace(".","");
	strCPF = strCPF.replace(".","");
    var Soma;
    var Resto;
    Soma = 0;
	if (strCPF == "00000000000") return false;
    
	for (i=1; i<=9; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
	Resto = (Soma * 10) % 11;
	
    if ((Resto == 10) || (Resto == 11))  Resto = 0;
    if (Resto != parseInt(strCPF.substring(9, 10)) ) return false;
	
	Soma = 0;
    for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
    Resto = (Soma * 10) % 11;
	
    if ((Resto == 10) || (Resto == 11))  Resto = 0;
    if (Resto != parseInt(strCPF.substring(10, 11) ) ) return false;
    return true;
}

function validaCpf() {
	var erro = 0;
	if(form1.telefone.value.length < 14){
		alert("Telefone inválido");
		var erro = 1;
	}
	if(TestaCPF(form1.cpf.value) != true){
		alert("CPF inválido.");
		var erro = 1;
	}
	if(form1.cep.value.length < 10){
		alert("CEP inválido.");
		var erro = 1;		
	}
	if(erro == 1){
		return false;
	}
	else{
		return true;
	}
}

function checkCard(num){
	var msg = Array();
	var tipo = null;
	
	if(num.length > 16 || num[0]==0){
		
		msg.push("Número de cartão inválido");
		
	} else {
		
		var total = 0;
		var arr = Array();
		
		for(i=0;i<num.length;i++){
			if(i%2==0){
				dig = num[i] * 2;
					
				if(dig > 9){
					dig1 = dig.toString().substr(0,1);
					dig2 = dig.toString().substr(1,1);
					arr[i] = parseInt(dig1)+parseInt(dig2);
				} else {
					arr[i] = parseInt(dig);
				}
							
				total += parseInt(arr[i]);
	
			} else {
	
				arr[i] =parseInt(num[i]);
				total += parseInt(arr[i]);
			} 
		}
				
		switch(parseInt(num[0])){
			case 0:
				msg.push("Número incorreto");
				break;
			case 1:
				tipo = "Empresas Aéreas";
				break;
			case 2:
				tipo = "Empresas Aéreas";
				break
			case 3:
				tipo = "Viagens e Entretenimento";
				if(parseInt(num[0]+num[1]) == 34 || parseInt(num[0]+num[1])==37){	operadora = "Amex";	} 
				if(parseInt(num[0]+num[1]) == 36){	operadora = "Diners";	} 
				break
			case 4:
				tipo = "Bancos e Instituições Financeiras";
				operadora = "visa";
				break
			case 5:
				if(parseInt(num[0]+num[1]) >= 51 && parseInt(num[0]+num[1])<=55){	operadora = "Mastercard";	} 
				tipo = "Bancos e Instituições Financeiras";
				operadora = "Mastercard"
				break;
			case 6:
				tipo = "Bancos e Comerciais";
				operadora = "";
				break
			case 7:
				tipo = "Companhias de petróleo";
				operadora = "";
				break
			case 8:
				tipo = "Companhia de telecomunicações";
				operadora = "";
				break
			case 9:
				tipo = "Nacionais";
				operadora = "";
				break
			default:
				msg.push("Número incorreto");
				var valido = 0;
				return valido;
				break;
			}

}
	
if(msg.length>0){	
	
	console.log(msg);	

} else {
	
	console.log(num);
	
		if(total%10 == 0){
			var valido = 1;
		} else {
			var valido = 0;
		}
		return valido;
	}
	
}

function validaMeioPagamento(){
	var valido = checkCard(meioPagamento.cardNumber.value);
	if(valido == 0){
		alert("Cartão de crédito inválido.");
		return false;
	}
}