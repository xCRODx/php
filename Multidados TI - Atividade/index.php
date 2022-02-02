<?php
require_once("template.php");
require_once("cabecalho.php");
require_once("menu.php");
require_once("rodape.php");
require_once("DataRequest.php");

class Index extends Template{
  public $pagina;
  
  function __construct(){
    $request = new DataRequest();
    $index["numeroUsuarios"] = $request->dadosUsuarios("c");
    $index["numeroClientes"] = $request->dadosClientes("c");
    $index["numeroFornecedores"] = $request->dadosFornecedores("c");
    
    $cabecalho = new CabecalhoComponente();
    $index["cabecalho"] = $cabecalho->componente;
    
    $menu = new MenuComponente();
    $index["menu"] = $menu->componente;
    
    $rodape = new RodapeComponente();
    $index["rodape"] = $rodape->componente;
    
    //caso não precise de tratamento de dados, o template pode ser carregado direto da classe pai
    $index["tabelaSimples"] = $this->carregar("tabelaSimples");
    
    $this->pagina = $this->carregar("index", $index);
  }
}

//carrega o componente Index e imprime na tela
$index = new Index();

echo $index->pagina;