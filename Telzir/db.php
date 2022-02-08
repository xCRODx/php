<?php
/*
  *This script get data from a DB.
  *getAvailableDDD = returns the available dddDestination from dddOrigin.
  
  getValuePerMinute = return the value of call based on combination of the dddOrigin and dddDestination
*/
require("config.php");

#-•-•-•-•-••- Connect to DB  -•-•-•-•--•-•-
 function connect(){
  try{
    $DB = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASS);
    $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $DB;
  }catch ( PDOException $e ){
     $data["error"] = 'Não foi possível conectar no Banco de Dados: '.$e->getMessage();
     die(json_encode($data));
  }
 }
#-•-•-•-•-•-•-•-•-•-•-•-•-•-•-•-•-•-•-•-•-

//Value per minute from origin and destination match
function getValuePerMinute($dddOrigin, $dddDestination){
  
  $DB = connect();
  $sql = "SELECT value FROM consulta WHERE (dddOrigin = $dddOrigin AND dddDestination = $dddDestination)";
  $data = $DB->query($sql);
  $data = $data->fetch(PDO::FETCH_ASSOC);
  
  if($data){
   return $data["value"];
  }else{
    $data["error"] = "Combinação de DDD's errada.";
    die(json_encode($data));
  }
  
}//getValuePerMinute()

function getAvailableDDD($dddOrigin){
  $DB = connect();
  $sql = "SELECT dddDestination FROM consulta WHERE (dddOrigin = '$dddOrigin')";
  $data = $DB->query($sql);
  $data = $data->fetchAll(PDO::FETCH_ASSOC);
  
  if($data){
   return $data;
  }else{
    $data["error"] = "DDD de origem não existe.";
    die(json_encode($data));
  }
  
}