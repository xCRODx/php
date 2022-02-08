<?php
require_once("db.php");
require_once("template.php");
require_once("cards.php");

#Start a new Index Template
class Index extends Template{
  function __construct(){
    
    $main["header"] = $this->load("header");
    $main["footer"] = $this->load("footer");
    
    $card = new Cards();
    $index["cards"] = $card->component;
    $index["date"] = date("d/m/Y - h:i");
    
    $main["page"] = $this->load("index",$index);
   
    $this->page = $this->load("main", $main);
  }
}

$index = new Index();
echo $index->page;