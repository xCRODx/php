<?php
require_once("template.php");
class RodapeComponente extends Template{
  public $componente;
  function __construct(){
   $this->componente = $this->carregar("rodape");
  }
}