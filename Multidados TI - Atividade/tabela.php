<?php
require_once("template.php");
class Tabela{
  
  function __construct($tabela){
   
    $tabelaHead = "<table class='table table-hover'><thead><tr>";
    $tabelaHeadFim = '</tr></thead><tbody>';
    
    $tabelaFim = "</tbody></table>";
    $itens = "";
    for($i = 0; $i<count($tabela); $i++){
      $itens .= "<tr>";
      
      foreach($tabela[$i] as $key => $value){
        //se for a primeira index da tabela[0] adiciona os itens do head
        if($i == 0){
          $itensHead .= "<th>$key</th>";
        }
        
        $itens .= "<td>$value</td>";
      }//end foreach item

      $itens .= "</tr>";
    }//end foreach index

    $this->tabela = $tabelaHead.$itensHead.$tabelaHeadFim.$itens.$tabelaFim;

  }//fim __construct()
  
  function mostrar(){
    return $this->tabela;
  }
}