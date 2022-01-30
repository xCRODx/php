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
            $bo->action->get("nomeLoja")      && $bo->action->get("usuarioID")    && $bo->action->get("imagemLoja")   &&
            $bo->action->get("dadosLoja")   && $bo->action->get("formaEnvio")    &&
            $bo->action->get("lat")    && $bo->action->get("lon")
        ){//&& $bo->action->post("ApiKey")){#ADICIONAR DEPOIS

        #dados a serem lidados nessa pagina   
            ///echo "logado";
        $data = array( 
            "nomeLoja" => $bo->action->get("nomeLoja"), 
            "usuarioID" => $bo->action->get("usuarioID"), 
            "ipUsuario" => IP_USUARIO,
            "imagemLoja" => $bo->action->get("imagemLoja"), 
            "dadosLoja" => $bo->action->get("dadosLoja"),
            "formaEnvio" => $bo->action->get("formaEnvio"), 
            "formaPagamento" => $bo->action->get("formaPagamentto"), 
            "lat" => $bo->action->get("lat"),
            "lon" => $bo->action->get("lon"), 
            "bioLoja" => $bo->action->get("bioLoja"),
        );

        #lojaPntos: 
        //primeiras 1000 começarão com 50 pontos
                    //primeiras 500 começarão com 100 pontos(e maior que 100)
                    //primeiras 100 começarão com 150 pontos(e maior que 50)
                    //primeiras 50 começarão com  200 pontos
        
        $nl = $bo->db->numLojasCadastradas();

        if($nl <= 50){
            $data['lojaPontos'] = 200;
        }elseif($nl > 50 && $nl <= 100){
            $data['lojaPontos'] = 150;
        }elseif($nl > 100 && $nl <= 500){
            $data['lojaPontos'] = 100;
        }elseif($nl > 500 && $nl <= 1000){
            $data['lojaPontos'] = 50;
        }

            //echo 'logado';
            if($bo->db->addLoja($data) == true){
                ##### caso a loja tenha sido criada com sucesso ##############
                $usuarioID = $bo->action->get("usuarioID");
                //$filtro['lojaID'] = $data['lojaID'];
                //$itens = lerItens($filtro, $ordem=0, $rowORnum = 'row');
                $usuario = $this->db->getUsuario("todos","(id = '$usuarioID')","row");
                $loja = $bo->db->getLoja("todos","(usuarioID = '".$usuario['id']."')","row");

                $enviar['data'] = $loja;#retorna todos os itens em array
                $enviar['status'] = 1;##item criado com sucesso
                
            }else{
                $enviar['status'] = 2; #erro ao criar loja
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