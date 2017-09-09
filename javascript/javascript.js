function pesquisar(){
	var campo = document.getElementById("campoPesquisa").value;
	if(campo == ""){
		return false;
	}
	else{
		return true;
	}
}
function buttonMenos(param){
	document.raiva.action = "campoQuantidade.php?botao=menos";
	document.raiva.submit();
}
function buttonMais(param){
	document.raiva.action = "campoQuantidade.php?botao=mais";
	document.raiva.submit();
}
function confirmation(){
	if(confirm("Tem certeza que deseja remover esse produto do seu carrinho ?")){
		return true;
	}
	else{
		return false;
	}
}