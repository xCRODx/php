<?php
#carrega biblioteca;
$bo = new BO();
#usar lib ssession;
$bo->ssession = new SSession(IP_USUARIO);
#usar lib db;
$bo->db = new DataBase($autoConnect = true);
#usar lib action;
$bo->action = new action();

# bo->classe->metodo/variavel

############ RTESPOSTA PARA O APP ##################
#Array será convertida em JSON para ser lida pelo APP
#@status:   {1: usuario criado, 2: usuario existe, 3: já está conectado neste aparelho}
#@conexao:  {}
$enviar = array(
  'conexao' =>  '',#retorna a conexao atual caso venha a ter sucesso
  'status'  =>  '',#retorna o status de exito ou falha sobre a requisição
  'data'    =>  '' #retorna os dados mais importantes sobrea requisicao
);
####################################################

$CON = $bo->db->con;

##################### ACTION PAGES DE REGISTRO E ATIVAÇÂO DA PRIMEIRA SESSÂO #####################

#cria uma sessão
if($bo->ssession->checar_integridade() ##checa se o ip da sessao confere com o ip da maquina usada
//&& $bo->db->checar_login($bo->ssession->dados_login())//caso seja necessario autenticação.
//&& ($bo->action->get("apiKey") == APIK_KEY) #api key para liberar acesso ao apllicativo
){

    //$msg = "<br>usuario adicionadoa";
    //$bo->log($msg."<br>".$bo->ssession->get("usuario_ip"));
    
    //$c = 
    //$bo->log($msg."<br>".$bo->ssession->decrypt($c));
    if($bo->action->get("telefone") && $bo->action->get("nome") && $bo->action->get("pin")   ){//&& $bo->action->post("ApiKey")){#ADICIONAR DEPOIS
      $bo->action->log("Dados recebidos Corretamente");
    #dados a serem lidados nessa pagina   
        $data = array( 
            "telefone" => $bo->action->get("telefone", $CON), 
            "nome" => $bo->action->get("nome", $CON), 
            "pin" => $bo->action->get("pin", $CON), 
            "ipUsuario" => IP_USUARIO
        );
    //$g = $bo->db->getUsuario();
      //          if(!$g == false){echo $g["telefone"];}else{echo "gaasdgadf";}

    #se nao existir conexao com essas credenciais

      
      //$con = $bo->ssession->get("conexao");
      //echo $con["usuarioSID"];
      $nome = $data["nome"];
      $ipUsuario = IP_USUARIO;
      $pin = $data["pin"];
      //echo "8";
      $bo->action->log("Checando se conexao já existe no banco de dados ?? ".IP_USUARIO);

      #está conectado no aparelho com esse nome?
      if(($bo->db->getConexao("todos", "(nome = '$nome') AND (ipUsuario = '$ipUsuario') ","num")<1)
        ## && ($bo->action->tempo($conexao['ultimoAcesso'],DIAS) < 2) 
        ## && ($conexao['ativa'] == 1) 
                                        ){

        $bo->action->log("Conexão não existe, Pode criar usuario");

        #se adicionar usuario e der tudo certo
        $bo->action->log("Adcionando Usuario ao DB");
        if($USER = $bo->db->addUsuario($data)){
            $bo->action->log("Usuario Adcionado com sucesso");

            #criar uma nova conexão se não existir uma antiga com o nome e o ip semelhante         
            if($bo->db->novaConexao($data)){
              $bo->action->log("Nova conexão registrada na DB");
            }else{
              $bo->action->log("Erro ao Registrar a conexao na DB");
            }##IF que cria uma conexao
                    
            #Salvando conexao na Ssession
            #atribue a conexao atual a variavel conexao
            $conexao = $bo->db->getConexao("todos", "(nome = '$nome') AND (ipUsuario = '$ipUsuario') ","row");
            #atribui cada valor da conexao a Ssession
            foreach ($conexao as $key => $value) {
              $bo->ssession->set("conexao.".$key,$value);
            }#######salva na sessao (conexao.nomeCampo)


            //$bo->ssession->set("conexao",$conexao);

            #armazena os dados de conexao para ser convertida em uma json
            $enviar['conexao.'] = $conexao;#dados da conexao
            $enviar['status'] = 1; #retorna status 1 usuario criado
            
            #associa os dados do usuario na db como uma array a $usuario        
            $usuario = $bo->db->getUsuario("todos", "(nome = '$nome') AND (pin = '$pin') ", "row");#Salva os dados do login do usuario na ssession
            foreach ($usuario as $key => $value) {
              $bo->ssession->set("loginUsuario.".$key,$value);
            }#######salva na sessao (loginUsuario.nomeCampo)
            
            #coloca o usario dentro da index data para enviala ao APP
            $enviar['data'] = $usuario;
    

            }else{#se usuario nao for criado criado com sucesso
                $enviar['conexao'] = false;#dados da conexao
                $enviar['status'] = 2; #retorna status 2 erro usuario ja existe
                $enviar['data'] = false;#erro ao criar usuario
            }
        }else{#se ja houver conexao ativa
            $enviar['conexao'] = false;#dados da conexao
            $enviar['status'] = 3; #retorna status 2 erro ao criar conexao que ja existe
            $enviar['data'] = false;#erro ao criar usuario
        }
       
            //json_encode($enviar);
            $bo->action->enviar($enviar);
            //escreve os dados organizados em JSON e encriptado em base64 2x
        
        }

    /**
     * 
     @imprime essa array contendo os valores dos dados d 
     @@ex:
     @{"data":{"id":"1","ipUsuario":"1270","dataAcessoCriado":"2021-01-30 13:38:15","usuarioSID":"d8d8c9b49d8852b1a5bc670d83291771e9e36f45","ativa":"1","ultimoAcesso":"2021-01-30 13:38:15","nome":"Cleydson"},"status":3}
  
     @A conexao com IP vai ser checada quando se estiver logado ou sendo usadas nas outras Action Pages
    */


}
//$log = returnLog();
//$bo->db->desativarConexao();

echo $bo->action->logData;
$bo->db->fecharConexao();
$data['reserved'] = "NOW()";
//$bo->db->insert("",$data);
//echo $bo->ssession->get("conexao.nome");