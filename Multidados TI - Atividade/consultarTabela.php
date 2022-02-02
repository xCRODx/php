<?php
require("DataRequest.php");
require("tabela.php");

$request = new DataRequest();

if(isset($_POST["tabela"])){
  
  $tabela = $_POST["tabela"];
  switch ($tabela) {
    
    case 'clientes':
      $resultado = $request->dadosClientes();
      break;
    
    case 'usuarios':
      $resultado = $request->dadosUsuarios();
    break;
    
    case 'fornecedores':
      $resultado = $request->dadosFornecedores();
    break;
    
    //se não existir a tabela solicitada
    default:
      die("<center><p>Tabela não encontrada!</p></center>");
    break;
  }//end Switch

  $tabela = new Tabela($resultado);
  echo $tabela->mostrar();
}else{
  header("location: index.php");
}