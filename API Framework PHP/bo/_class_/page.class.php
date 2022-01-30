<?php

class Page{
  public $page;
  function __construct($page){
    $this->page = $page;
    require_once "_page_/".$page.".page.php";
  }
  function mostrar($view){
    require_once "_view_/".$page.".page.php";
  }
  
}