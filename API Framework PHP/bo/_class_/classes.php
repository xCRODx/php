<?php
/**
 * Script que carrega as classes
dev: Cleydson Rodrigues
 */
$auto_load_class = array(
	"ssession" ,
	"database", 
	"usuario",
	"loja",
	"page"
	
);

#    require_once "medoo.class.php";
function loadClass($class){
	foreach ($class as $key => $value) {
		$f = $value.".class.php";
		//if(file_exists($f)){
		//echo $f;
			require_once $f;
		//}	
	}
	
}

loadClass($auto_load_class);
/**
    require_once "db_m.class.php";
    require_once "ssession.class.php";
    require_once "loja.class.php";
    */
    