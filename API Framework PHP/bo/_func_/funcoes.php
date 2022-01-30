<?php

    //
    $auto_load_func = array(
	 	 "cripto" #funcao escreve(echo) uma mensagem encriptada para o navegador
		,"enviar" 
		,"log"
		
	
	);

    function loadFunc($func){
	foreach ($func as $key => $value) {
		$f = $value.".func.php";
		//if(file_exists($f)){
		//echo $f;
			require_once $f;
		//}	
	}
	
}

loadFunc($auto_load_func);