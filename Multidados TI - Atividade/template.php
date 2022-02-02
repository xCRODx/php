<?php
class Template{
  public $templateExt = ".tpl";
  public $templatePasta = "assets/tpl/";
  
  public function carregar($template, $valores=false){
    $arquivo = $this->templatePasta.$template.$this->templateExt;
    if(file_exists($arquivo)){
      
      $template = file_get_contents($arquivo);
      if($valores){
        foreach ($valores as $key => $value){
          
          $template = str_replace("{{".$key."}}",$value,$template);
        }
      }
      return $template;
      
    }else{
      die("ERRO AO CARREGAR TEMPLATE: ($arquivo)");
    }
  }//fim carregar()
}