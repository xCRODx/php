<?php
//defina aqui as opções do Menu
define("OPCOES_MENU", array (
  "cadastro" => array("Perfil de Acesso","Cliente", "Fornecedor", "Usuário", "Produtos"),
  
  "relatorio" => array("Faturamento","Produtos", "Cliente")
));


require_once "template.php";

class MenuComponente extends Template{
  public $componente;
  function __construct(){
    
    $subMenu = OPCOES_MENU;
    sort($subMenu["cadastro"]);
    sort($subMenu["relatorio"]);
    
    $cadastro = "";
    foreach ($subMenu["cadastro"] as $key => $value) {
      $cadastro .= "<li><a href='#'>$value</a></li>";
    }
    
    $relatorio = "";
    foreach ($subMenu["relatorio"] as $key => $value) {
      $relatorio .= "<li><a href='#".$value."'>$value</a></li>";
    }
    $subMenu["relatorio"] = $relatorio;
    $subMenu["cadastro"] = $cadastro;
    
    $this->componente = $this->carregar("menu", $subMenu);
  }

}