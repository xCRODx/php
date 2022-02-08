<?php
/*
  *Autor: Cleydson Rodrigues

  *this script manage ajax requests
*/

require("db.php");

# Getting POST values
$dddOrigin = isset($_POST["dddOrigin"]) ? $_POST["dddOrigin"] : false;

$dddDestination = isset($_POST["dddDestination"]) ? $_POST["dddDestination"] : false;

$promo = isset($_POST["promo"]) ? intval($_POST["promo"]) : false;

$callDuration = isset($_POST["callDuration"]) ? intval($_POST["callDuration"]) : false;

//if FrontEnd want to know values of promotion
$getValues = isset($_POST["getValues"]) ? true : false;

//if want to receive the availableDDD
$getAvailableDDD = isset($_POST["getAvailableDDD"]) ? true : false;

$getValuePerMinute  = isset($_POST["getValuePerMinute"]) ? true : false;
#•-•-•-•-•-•-•-•-•-•-•-•-•-•-•-•-•-•-•-•-•-

//if all data posts correctly
if($getValues && $dddOrigin && $callDuration && $promo && $callDuration && $getValues){
  
  //value from gotten from database.
  $data["valuePerMinute"] = $valuePerMinute = getValuePerMinute($dddOrigin,$dddDestination);
  
  $data["timeExceeded"] = $timeExceeded = $callDuration - $promo;
 
  $data["discountValue"] = $callDuration > $promo ? ($timeExceeded*$valuePerMinute)*1.10 : 0;
  
  $data["noDiscountValue"] = ($callDuration*$valuePerMinute);
  
  $data["promo"] = $promo;
  
  $data["callDuration"] = $callDuration;
  
  
}elseif($getAvailableDDD && $dddOrigin){
  $data["availableDDD"] = getAvailableDDD($dddOrigin);
  
  //if only wants value per minute each combination DD
}elseif($getValuePerMinute && $dddOrigin && $dddDestination){
  $data["valuePerMinute"] = getValuePerMinute($dddOrigin,$dddDestination);
  
}else{
  //if any post data is sending incorrectly
  //return json data with a error message
  $data["error"] = "Defina os dados de consulta corretamente!";
}
echo json_encode($data);