<?php

//  Script criado por: Cleydson Rodrigues
// Transforma uma mensagem em uma resposta json pra ser melhor interpretada ppelo script js ao fazer a requisição AJAX.

require_once "cripto.func.php";
function enviar($msg, $enc = false){
	$msg = json_encode($msg);
	#se quiser que a mensagem seja encriptada
  #não influência na segurança dos dados.
    if($enc){$msg = encrypt($msg); echo $msg;}else{echo $msg;}
}