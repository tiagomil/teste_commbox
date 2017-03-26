<?php

$arquivo = $_POST['arquivo'];
$caracter = $_POST['caracter'];

if (($arquivo != '') && ($caracter != '')){
	$conteudo_texto = file_get_contents($arquivo);
	$caracter_explode = explode($caracter, $conteudo_texto);
	$qtd_caracter = count($caracter_explode);
	$caracter_subtrai = $qtd_caracter - 1;

	echo 'O conteúdo do arquivo texto anexado possui ' . $caracter_subtrai . ' ' . 'Caracter(es)' . ' ' . '<b>'.$caracter.'</b>' . ' ! ';
} else {
	header("Location: index.php");
}

?>