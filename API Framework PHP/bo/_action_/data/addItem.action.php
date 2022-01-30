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


################################ ACTION PAGE QUE ADICIONA UM ANUNCIO A LOJA ####################################

####################################### AUTENTICACAO AUTOMATICA #################################################
if($bo->ssession->checar_integridade() 
&& $bo->db->checar_login($bo->ssession->dados_login())//caso seja necessario autenticação.
//&& ($bo->action->get("apiKey") == APIK_KEY)
){
###############################################################################################################
        //$msg = "<br>usuario adicionadoa";
        //$bo->log($msg."<br>".$bo->ssession->get("usuario_ip"));
     
        //$c = 
        //$bo->log($msg."<br>".$bo->ssession->decrypt($c));
        if( 
            $bo->action->get("lojaID")      && $bo->action->get("usuarioID")    && $bo->action->get("precoAtual")   &&
            $bo->action->get("categoria")   && $bo->action->get("descricao")    && $bo->action->get("fotos")        &&
            $bo->action->get("nomeItem")    && $bo->action->get("estoque")
        ){//&& $bo->action->post("ApiKey")){#ADICIONAR DEPOIS

        #dados a serem lidados nessa pagina   
            ///echo "logado";
        $data = array( 
            "lojaID" => $bo->action->get("lojaID"), 
            "usuarioID" => $bo->action->get("usuarioID"), 
            "ipUsuario" => IP_USUARIO,
            "precoAtual" => $bo->action->get("precoAtual"), 
            "categoria" => $bo->action->get("categoria"),
            "descricao" => $bo->action->get("descricao"), 
            "fotos" => $bo->action->get("fotos"),
            "nomeItem" => $bo->action->get("nomeItem"), 
            "estoque" => $bo->action->get("estoque"),
        );
        
            //echo 'logado';
            
            ######db será trocado por loja
            if($bo->db->addItem($data)){
                ##### retorna todos os itens da loja ##############
                
                $filtro['lojaID'] = $data['lojaID'];
                $itens = lerItens($filtro, $ordem=0, $rowORnum = 'row');
                $enviar['data'] = $itens;#retorna todos os itens em array
                $enviar['status'] = 1;##item criado com sucesso
                
            }else{
                $enviar['status'] = 2; #erro ao criar item
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


}#################################################### if AUTENTICADO
else{
    $enviar['status'] = 3; #erro ao criar item Usuario não auttenticado;
    $enviar['statusMsg'] = "Usuário não autenticado"; #mensagem de erro
}
$bo->action->enviar($enviar);