<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title>Contador de Caracteres</title>
		<script language="javascript" type="text/javascript">
		
			function valida_campos(){
				if(document.getElementById("campo_arquivo").value == ""){
					alert('Por favor, selecione um arquivo texto');
					document.getElementById("campo_arquivo").focus();
					return false;
				} else if (document.getElementById("campo_caracter").value == ""){
					alert("Por favor, digite um caractere");
					document.getElementById("campo_caracter").focus();
					return false;
				} else {
					alert("Dados enviados com sucesso !");
				}
			}

		</script>
	</head>
	<body>
		<form id="form1" method="post" action="conta_caractere.php">
			<div>
				<h4>Selecione o arquivo de texto:</h4>
				<input type="file" id="campo_arquivo" name="arquivo" />
				<br>
				<h4>Digite o caracter que deseja pesquisar no arquivo texto:</h4>
				<input type="text" id="campo_caracter" name="caracter" maxlength="1" />
				<br>
			</div>
			<button type="buttom" onClick="valida_campos()">Pesquisar</button>
		</form>
	</body>
</html>