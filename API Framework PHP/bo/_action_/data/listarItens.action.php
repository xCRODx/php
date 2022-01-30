<?php
#carrega biblioteca;
$bo = new BO();
#usar lib ssession;
$bo->ssession = new SSession(IP_USUARIO);
#usar lib db;
$bo->db = new DataBase();
#usar lib action;
$bo->action = new action();

# bo->classe->funcao/variavel


################################ ACTION PAGE QUE LISTA ITENS DE ACORDO COM ALGUM FILTRO ####################################
#carrega o login;
if(true//$bo->ssession->checar_integridade() 
//&& $bo->db->checar_login($bo->ssession->dados_login())//caso seja necessario autenticação.

){

    //$msg = "<br>usuario adicionadoa";
    //$bo->log($msg."<br>".$bo->ssession->get("usuario_ip"));
    
    //$c = 
    //$bo->log($msg."<br>".$bo->ssession->decrypt($c));
    if(defined("BASEPATH")){//&& $bo->action->post("ApiKey")){#ADICIONAR DEPOIS

    #dados a serem lidados nessa pagina   
    if(false == true){
    $data = array( 
        "telefone" => $bo->action->get("telefone"), 
        "username" => $bo->action->get("username"), 
        "ipUsuario" => IP_USUARIO
    );}
    //$g = $bo->db->getUsuario();
      //          if(!$g == false){echo $g["telefone"];}else{echo "gaasdgadf";}

    #se nao existir conexao com essas credenciais



    #se existir os filtros
    if($bo->action->get("preco") && $bo->action->get("precoMin") && $bo->action->get("precoMax")){
        $filtro['precoMin'] = $bo->action->get("precoMin");
        $filtro['precoMax'] = $bo->action->get("precoMax");
        $filtro['preco'] = $bo->action->get("preco");

    }else{
        $filtro = false;
        
    }

    #se existir as ordens
    if($bo->action->get("ordem")){
        $ordem = $bo->action->get("ordem");
    }
    else{$ordem = 0;}

      
      //$con = $bo->ssession->get("conexao");
      //echo $con["usuarioSID"];
      if($bo->action->get("paginaAtual") && $bo->action->get("itensPagina") ){//&& $bo->action->get("paginaAtual")){
        
        $itensPagina = $bo->action->get("itensPagina"); #quantidade de Itens Por pagina
        $PaginaAtual = $bo->action->get("paginaAtual"); #numero de

        //$totalItensDB = $bo->db->lerItens();

        
        $numeroItensDB = $bo->db->lerItens($filtro, $ordem, "num");
        $numeroPaginas = $numeroItensDB / $itensPagina;

        $paginaItemInicio = ($itensPagina * $paginaAtual) - $itensPagina;#comeco do limter, para o primeiro item da pagina
        $paginaItemFinal = $itensPagina * $paginaAtual;
        $query = "LIMIT $paginaItemInicio, $paginaItemFinal";


        $resultado['data'] = $bo->db->lerItens($filtro, $ordem, "row", $query);
        $resultado['pagina'] = array(
            "numeroPaginas" => $numeroPaginas,
            "numeroItens"   => $numeroItensDB
        );

        $bo->action->enviar($resultado);



        //$numeroItens = $this->lerItens($filtro,$ordem,"num");#numero total de itens nessa pesquisa
        //$paginaTotal = ($numeroItens/);
    }



    }
    /**
     * 
     *imprime essa array contendo os valores dos dados d 
     *{"data":{"id":"1","ipUsuario":"1270","dataAcessoCriado":"2021-01-30 13:38:15","usuarioSID":"d8d8c9b49d8852b1a5bc670d83291771e9e36f45","ativa":"1","ultimoAcesso":"2021-01-30 13:38:15","username":"Cleydson"},"status":3}
     *
     *#fazer um SELECT na Database para pegar os dados de IP e cria uma nova conexao com esse IP e salva na DB
     *#A conexao com IP vai ser checada quando se estiver logado ou sendo usadas nas outras Action Pages
    */


}