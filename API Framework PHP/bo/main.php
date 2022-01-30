<?php
  //namespace BrasOn\App;
  //namespace NewCE;
  //Principal classe da estrutura do framework
    class BO{
        public $action, $db, $ssession, $config, $logData;

        function __construct($config=array()){
            $this->logData = "";

            $this->config = $config;

            if(!isset($config['lang'])){
                $this->config['lang'] = "pt-br";
            }
            //$this->action->loadaction();
            
        }
        function getLang(){
            return $this->config['lang'];
        }

        function log($msg){$this->logData .= newline."<td> $msg </td>";}

        function validarAPI($apiKey){
            if(DEV){return true; }else{#codigo para validar API de acesso no APP
                
            }
        }
    }#class BO
    //$bo = new BO();
   

    $action = new Action();
    //se existir um get na pagina e não estiver vazio
    $p = $action->get("page");
    if($p and !empty($p) ){
      
     $p = $action->get("page");
    // $page = new Page("$p");
     
    }else{
      
      //$page = new Page("index");
      //$page->mostrar("index");
    }
    
    
    
   //$action->loadAction();
    