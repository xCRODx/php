<?php
/*
  * This script loads a .tpl file and print values on {{key}} tags. This can be used as a simple template engine.
*/

class Template{
  public $templateExt = ".tpl";
  public $templateFolder = "templates/";
  
  public function load($template, $data=false){
    $file = $this->templateFolder.$template.$this->templateExt;
    if(file_exists($file)){
      
      $template = file_get_contents($file);
      if($data){
        foreach ($data as $key => $value){
          $template = str_replace("{{".$key."}}",$value,$template);
        }
      }
      return $template;
      
    }else{
      die("ERRO AO CARREGAR TEMPLATE: ($file)");
    }
  }//end load()
}