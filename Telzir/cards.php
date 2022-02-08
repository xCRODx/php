<?php
class Cards extends Template{
  //Configure all promo here.
  private $promo = 
    [["promo" => 30, "promoName" => "#FaleMais30"],
    ["promo" => 60, "promoName" => "#FaleMais60"],
    ["promo" => 120, "promoName" => "#FaleMais120"]];
  
  function __construct(){
    $cards = "";
    for ($i = 0; $i < count($this->promo); $i++) {
      
      $card = $this->promo[$i];
      
      $data["promo"] = $card["promo"];
      $data["promoName"] = $card["promoName"];
      $cards .= $this->load("index/promoCards",$data);
    }
    $this->component = $cards;
  }
  
}