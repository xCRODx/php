const visualizarTabela = (tabela) => {
  
  let tabelaSimples = document.getElementById("tabelaSimples");
  
  
  switch (tabela) {
    
    case 'clientes':
      tabelaSimples.classList.remove("grey");
      tabelaSimples.classList.remove("green");
      tabelaSimples.classList.remove("purple");
      tabelaSimples.classList.add("blue");
     
      $("#captionTabela").text("Tabela de Clientes");
    break;
    
    
    case 'usuarios':
      tabelaSimples.classList.remove("grey");
      tabelaSimples.classList.remove("blue");
      tabelaSimples.classList.remove("purple");
      tabelaSimples.classList.add("green");
      $("#captionTabela").text("Tabela de Usuarios")
    break;
    
    
    case 'fornecedores':
      tabelaSimples.classList.remove("grey");
      tabelaSimples.classList.remove("green");
      tabelaSimples.classList.remove("blue");
      tabelaSimples.classList.add("purple");
      $("#captionTabela").text("Tabela de Fornecedores");
    break;
  }
  
  $.ajax({
        method: "POST",
        url: "consultarTabela.php",
        data: { tabela: tabela},
        beforeSend : function(){
          $("#tabelaSimplesConteudo").html("<center>Carregando tabela...<br><img src='assets/img/loading.gif' alt='Carregando tabela...'></center>");
            }
      }).done((msg)=>{
        $("#tabelaSimplesConteudo").html(msg)
      }).fail((jqXHR, textStatus, msg)=>{
        $("#tabelaSimplesConteudo").html("<center><p>Erro ao consultar tabela!</p></center>")
      });
  
}//fim visualizarTabela