<?php
#carrega biblioteca;
$bo = new BO();
#usar lib ssession;
//$bo->ssession = new SSession(IP_USUARIO);
#usar lib db;
$bo->db = new DataBase();
#usar lib action;
$bo->action = new action();

//$bo->ssession2 = new SSession(IP_USUARIO);

# bo->classe->funcao/variavel

//	@brason.net/index?action=perfil&nome=

########################### Pagina que autentica o usuario #########################

if($bo->validarAPI($bo->action->get("API"))){
	
	#se estiver fazendo o post/get correto dos dados
	//if($bo->action->get(USUARIO_pin) && $bo->action->get(USUARIO_nome) && $bo->action->get(USUARIO_telefone)){
		
		#associa os dados do USUARIO na array $data
		if($bo->action->get(USUARIO_nome)){
			$data[USUARIO_nome] = $bo->action->get(USUARIO_nome);
		}
		if($bo->action->get(USUARIO_telefone)){
			$data[USUARIO_telefone] = $bo->action->get(USUARIO_telefone);
		}
		if($bo->action->get(USUARIO_id)){
			$data[USUARIO_id] = $bo->action->get(USUARIO_id);
		}

		#caso queira retornar os dados do USUARIO logado
		#1 como verdadeiro e 0 como falso
		//$retornarDados = $bo->action->get("returnData");

		#associa o usuario
		#passa os dados e se conecta ao banco de dados
		$bo->usuario = new Usuario($data, true);

		#checa se esta logado
		
			#faz o login com os dados
			//$bo->usuario->login($data);
			//$bo->usuario->logado();
			//$bo->usuario->enviar(todos,todos);
			//$bo->usuario->desconectar();
			//$l = array("telefone" => 119455942192, "nome" => "Cleyds2on");
			//$bo->usuario->perfil($l);
			$bo->usuario->perfil($data);
			//$bo->usuario->cadastrar($data);

			#retorna está logado ou não
			enviar($bo->usuario->enviarDados);
			//dados sobre a requisição atual
			

			//$bo->usuario->ssession->set('ip', 1234);
			//echo "<br>".$bo->usuario->ssession->get("auth_".USUARIO_pin);
			//echo "<br>".$bo->usuario->ssession->get("auth_".USUARIO_id);

			//$bo->db->insert('usuario', $data);
			//$bo->db->desativarConexao();
			//print_r($_SESSION);
		
	
}