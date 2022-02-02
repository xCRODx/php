<?php
require_once("template.php");
class CabecalhoComponente extends Template{
  public $componente;
  function __construct(){
   $this->componente = $this->carregar("cabecalho");
  }
}