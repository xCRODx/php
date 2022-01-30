<?
/*				USUARIO
	*	Projeto: Ecomerce virtual com framework próprio.
	*	Criado por: Cleydson Rodrigues
	*	Iniciado em 09/03/2021

	## atua de acordo com o status de autenticação no sistema ✓ feito
	@responsável por verificar a integridade do Usuario ✓ feito
	@gerencia a propria conexao e autenticação ✓ feito
	@tem um perfil onde posta fotos e mensagens x ainda não feito
	@le e envia mensagens a outras lojas/Usuarios x ainda não feito
	@cria/apaga e edita lojas x - ainda não feito
	
	## construct{
		
	}

	##para cadastrar{
		nome: @publico unico
		telefone: numero de telefone @publico unico
		pin: senha @privado relevante encriptado
	}
	##para login{
		nome ou telefone
		pin para autenticar
    
	}
	
*/

class Usuario extends DataBase{
	public 	$auth, $conexaoDados, $loja, $posts;
	public 	$ssession, $logDados;
	public  $enviarDados;#array que contem dados para enviar para o APP front-end
	private $dados; #dados restritos de login 
	private $where;#facilita a busca na DB caso esteja procurando o usuario atual

	function __construct($data=array(), $con=false){
	 
		$this->logDados ="";
		$this->enviar = array();

		$this->dados = $data;

		#caso queira se conectar automaticamente ao banco de dados
		#ou se ainda não tiver conectado
		//if($this->con){$this->connect();}

		$this->ssession = new Ssession(IP_USUARIO);
		//$this->ssession->start();
		
		#associa dados restritos sobre o usuario a $dados
		$this->dados['ipUsuario'] =  IP_USUARIO;
		

	}

	#recebe os dados do usuario e os coloca na variavel privada $dados
	function receber($data){$this->dados = $data;}

	#funcao de log e envio de dados para o front-end
	function log($l){$this->logDados .= "<br> $l";return $this->logDados;}
	function enviar($k,$v){$this->enviarDados[$k] = $v;}

	#--------------- CRUD USUARIO------------------------
	#cadastra um novo usuario se ele já não existir
	#depois retorna os dados da conexao atual
	function cadastrar($data){
		if(isset($data[USUARIO_telefone], $data[USUARIO_nome], $data[USUARIO_pin])){
			$data[USUARIO_pin] = cripto($data[USUARIO_pin]);
			#associa os dados a variavel auth
			$this->auth = $data;
			
			

			#se a conexao ainda nao existe
			if(!$this->conexao('ler',false)){
        echo "conexao ler false: ainda não existe conexão";
				#verifica se usuario já existe
				if($this->existe($this->auth[USUARIO_telefone])){#??
				
					$this->enviar('status',ERROR_USUARIO_EXISTE);

					//echo "ERROR_USUARIO_EXISTE";
					return ERROR_USUARIO_EXISTE;

				}else{#se não continua na tentativa de registro

					#se der certo o cadastro
					$this->insert(DB_TABELA_USUARIO, $data);
					
				//	echo newline."var dump".newline;

		//	var_dump($this->auth);

	//		echo newline."var dump".newline;
					$qu = $this->select(DB_TABELA_USUARIO, todos, "telefone = ".$this->auth[USUARIO_telefone],num);
					//var_dump($qu);
					if($qu>0){
						//echo newline."tentou cadastro";
						## @@ USUARIO CRIADO COM SUCESSO
						#adciona uma mensagem ao front-end que usuario foi criado
						$this->enviar('status',MSG_USUARIO_CRIADO);
						$this->dados = $this->existe($data,true);
						$this->enviar('data',$this->dados);
						//print_r($this->dados);
						#se conseguir registrar uma conexão no DB

      
			
			
						if($this->conexao('criar')){
						 // echo newline."&&-++&(#)##"; 
							//echo "criou conexao";
							$this->conexaoDados = $this->conexao('ler',true);
							$this->enviar('conexao', $this->conexaoDados);
							$this->salvarCredenciais();

						}else{
							#se nao conseguir criar conexao depois de criar usuario
							$this->enviar('conexao', ERROR_CONEXAO_CRIAR);
						}#fim IF criar conexao

						return MSG_USUARIO_CRIADO;

					}#fim  se  der certo cadastro

				}#fim IF usuario existe

			}#fim conexao existe

			else{#ELSE conexao nao existe

				#se conexao já existe
				$this->enviar('conexao', ERROR_CONEXAO_EXISTE);
				return ERROR_CONEXAO_EXISTE;

			}#fim conexao existe ELSE

		}#fim IF isset()

	}##criar()
	
	#verifica se usuario já existe e retorna os dados se necessário
	# @{ $return } = É necessário retornar o objeto usuario? se não retorna um BOOL
	function existe($data=array(),$return = true){
		#select($tabela, $campos="*", $where="", $rowORnum="row")

		#aqui leva-se em consideração que ja se tem o telefone ou o nome
		#( (telefone = telefone) OU (nome=nome))
		
		#if(!isset($data[USUARIO_nome])){
		#$data[USUARIO_nome] = 1;
		#}#atribui valor 1 pra evitar erros
		//$data = array(
			//USUARIO_nome => $this->auth[USUARIO_nome],
			//USUARIO_telefone => $this->auth[USUARIO_telefone]
		//);
		$where = "(".USUARIO_telefone." = '".$this->auth[USUARIO_telefone]."')";
			if(isset($this->auth[USUARIO_pin]) || (!$this->auth[USUARIO_pin] == false)){
				$pin = $this->auth[USUARIO_pin];
				$where.= "AND (".USUARIO_pin." = '".cripto($pin)."')";
			}
			
		if($return){

			$r = $this->select(DB_TABELA_USUARIO, todos,"$where",row);
			return $r;
			
			
			
			
		}else{
			
			if($this->select(DB_TABELA_USUARIO, todos,"$where",num) > 0){
				
				return true;
				

			}else{
				return false;
			}
		}
	}#existe()

	#logar do zero, 
	function login($dados,$return=false){
		if($this->ssession->checarIntegridade()){
			#pega os dados da Ssession
			if(!isset($dados[USUARIO_telefone])){
				$dados[USUARIO_telefone] = "";
			}elseif(!isset($dados[USUARIO_nome])){
				$dados[USUARIO_nome] = "";
			}
			if(isset($dados[USUARIO_pin])){
				$telefone 	= $dados[USUARIO_telefone];
				$nome 		= $dados[USUARIO_nome];
				$pin 		= cripto($dados[USUARIO_pin]);

				//$this->auth = $dados;
				$where = "(".USUARIO_telefone." = '$telefone') 
							 OR (".USUARIO_nome." = '$nome')
							AND (".USUARIO_pin." = '$pin')";
				$r = $this->select(DB_TABELA_USUARIO, todos,"$where",row);
				if($r){
					if($con = $this->conexao('ler',true)){
						if($this->validarConexao()){
							$this->dados = $r;
							$this->salvarCredenciais();
							$this->enviar('status', MSG_USUARIO_LOGADO);
							$this->enviar('data', $r);
							$this->enviar('conexao',$con);
						}
					}
				}else{
					$this->enviar('status', ERROR_CREDENCIAIS_INCORRETAS);
				}
			}

		}#checarIntegridade()
	}#login()

	#verifica se credenciais existem e salva os dados em $this->auth
	#repete em toda requisição / toda atualização de pagina
	#$data false = pega os dados de AUTH_ da sessao
	#return true retorna ARRAY do usuario, return false retorna BOOL
	#
	function logado(){
		if($this->ssession->checarIntegridade()){
			if($this->conexao('ler')){
				#pega os dados da Ssession
				//echo "<h1>oi</h1>";
				#checa se tem dados salvos na ssessao
				if( $this->ssession->get("auth_".USUARIO_pin) 		AND
					$this->ssession->get("auth_".USUARIO_telefone)	AND
					$this->ssession->get("auth_".USUARIO_nome) ){

					$telefone 	= $this->ssession->get("auth_".USUARIO_telefone);
					$nome 		= $this->ssession->get("auth_".USUARIO_nome);
					$pin 		= $this->ssession->get("auth_".USUARIO_pin);
					$id  		= $this->ssession->get("auth_".USUARIO_id);
					//$this->auth = $dados;
					$where = "(".USUARIO_telefone." = '$telefone') 
								 OR (".USUARIO_nome." = '$nome')
								AND (".USUARIO_pin." = '$pin')";
					$r = $this->select(DB_TABELA_USUARIO, todos,"$where",num);
					if($r > 0){
						if($con = $this->conexao('ler',true)){
							//$this->dados = $r;
							//$this->salvarCredenciais();
							if($this->validarConexao()){
								$this->enviar('status', MSG_USUARIO_LOGADO);
								//$this->enviar('data', $r);
								$this->enviar('conexao',$con);
								return true;
							}
						}
					}else{
						$this->enviar('status', ERROR_CREDENCIAIS_INCORRETAS."");
						return false;
					}
				}#IF dados salvos na sessao

			}#IF conexao('ler')

		}#checarIntegridade()
	}#logado()

	#atualiza o usuario atual de acordo com os valores e campos e se estiver logado
	#
	function atualizar($set=array()){
		$id = $this->ssession->get("auth_".USUARIO_id);
		if($this->logado()){#se estiver logado no sistema

			if(isset($set[USUARIO_pin])){#criptografa a senha
				$set[USUARIO_pin] = cripto($set[USUARIO_pin]);
			}

			#pega o id da sessão
			$where = "".USUARIO_id." = '$id'";
			
			$this->update(DB_TABELA_USUARIO,$where,$set);
			//echo "<h1> fsdsdds $id</h1>";
		}else{
			//echo "<h1> nao esta logado $id</h1>";
		}

	}#atualizar
	
	#retorna os dados por algun campo especifico
	function perfil($campos){#se todos os campos conferirem
		/*
		@	ex:
		@	$data = array("nome"=> "Rodrigo", "telefone" => 11945594219);
		@	$this->perfil($data);
		@		retorna o perfil com esse nome e telefone especifico
		*/	
		$where = "";
		$i = 0;
		foreach ($campos as $key => $value) {
			if($i>0){ $where.= " AND ";}
			$where .= "(";
			$where .= " $key= '$value'";
			$where .= ")";
			$i++;
		}

		$r = $this->select(DB_TABELA_USUARIO, todos,$where,row);
		if($r){

			#retirando o PIN do retorno para evitar espertões
			if(isset($r[USUARIO_pin])){unset($r[USUARIO_pin]);}

			$this->enviar('status', MSG_CONSULTA_SUCESSO);
			$this->enviar('data', $r);
		}else{
			$this->enviar('status', ERROR_CONSULTA_FALHOU);
			$this->enviar('data', $r);
		}
	}
	##----------------------------------------------------------

	#------------------ CONEXAO -------------------
	#gerencia a nova conexao ao banco de dados
	# ex: @bool conexao('criar')//cria uma nova conxao retorna true se criar
	# ex: @array conexao('ler', true)//retorna a conexao atual da db
	# ex: @bool conexao('ler')//retorna se a conexao é valida com as credenciais
	
	function conexao($acao, $return=true){
		//echo "func conexao<br>";
		if($this->ssession->checarIntegridade()){#checa se o ip esta correto na ssessao
			echo "Checou integridadeHJGF<br>";
			
			switch ($acao) {
				case 'criar':
				  echo "criar".newline;
				//echo "Chegou aqui Switch Criar<br>";
					#se já tiver os dados de login (autenticação) já em mãos
        
					if(isset($this->auth[USUARIO_nome],$this->auth[USUARIO_telefone])){
						echo "Chegou aqui checou os dados<br>";
						
						$data = array(#dados de acesso
							CONEXAO_ativa => 1,
							CONEXAO_ipUsuario => IP_USUARIO,
							CONEXAO_dataAcessoCriado => AGORA,
							CONEXAO_usuarioSID => cripto($this->auth[USUARIO_nome].$this->auth[USUARIO_telefone]),
							CONEXAO_ultimoAcesso => AGORA,
							CONEXAO_nome => $this->auth[USUARIO_nome]
						);#array() 
						#cria uma nova conexao com os dados de acesso
						if($this->insert(DB_TABELA_CONEXAO, $data)){
							return true;#se conseguiu criar a conexao
						}else{
							return false;#se nao conseguiu criar a conexao
						}
					}#IF isset(auth) se nao tiver os dados nome e telefone já salvos
				break; #fim case 'criar' :
				
				case 'ler':
					if($return){
					  echo "ler";
						#retorna TRUE se existir uma conexao ativa com esse IP e ativa na DB

						$r = $this->select(DB_TABELA_CONEXAO, todos, "(".CONEXAO_ipUsuario." = '".IP_USUARIO."') AND (".CONEXAO_ativa." = 1)", row);
						if(!$r == false){
							$this->conexaoDados = $r;
							$sid = $this->conexaoDados[CONEXAO_usuarioSID];
							$set = array(CONEXAO_ultimoAcesso => 'NOW()');
							$this->update(DB_TABELA_CONEXAO,"".CONEXAO_usuarioSID." = '$sid' AND
												".CONEXAO_ativa." = 1  AND
										 		".CONEXAO_ipUsuario." = '".IP_USUARIO."'",$set);
						return $this->conexaoDados;

							//return true;
						}else{
							#falso se não existir conexão na DB
							if ($this->select(DB_TABELA_CONEXAO, todos, "(".CONEXAO_ipUsuario." = '".IP_USUARIO."') AND (".CONEXAO_ativa." = 1)", num)>0) {
								return true; #se existir essa conexao
							}else{
								return false; #se nao existir conexao
							}
							
						}#fim IF (!$r == false) se não existir conexao ativa
					}#fim $return - retornar array ou bool

				break;#fim case 'ler' :
			}#fim Switch

		}#fim checarIntegridade()
	}#fim conexao()

	#checa se existe uma conexao ativa com os dados salvos na variavel local da classe
	function validarConexao(){
		if($this->ssession->checarIntegridade()){
			$con = $this->conexaoDados;
			$ssid = $con[CONEXAO_usuarioSID];
			$r = $this->select(DB_TABELA_CONEXAO, todos, "(".CONEXAO_ipUsuario." = '".IP_USUARIO."') AND (".CONEXAO_ativa." = 1) AND (".CONEXAO_usuarioSID." = '$ssid')", num);
			if($r>0){return true;}else{return false;}
		}
	}


	##salva a conexao na ssessao
	function salvarCredenciais(){
		if($this->ssession->checarIntegridade()){
			#atribui cada valor da conexao a Ssession
			$conexao = $this->conexaoDados;
            foreach ($conexao as $key => $value) {
              $this->ssession->set("conexao_".$key,$value);
            }#######salva na sessao (conexao.nomeCampo)

            #atribui cada valor dos dados de login para Ssession
			$auth = $this->dados; 
            foreach ($auth as $key => $value) {
              $this->ssession->set("auth_".$key,$value);
            }#######salva na sessao (conexao.nomeCampo)
		}
	}

	# desconecta o usuario com esse ip @desconecta direto do aparelho
	function desconectar(){
		if($this->ssession->checarIntegridade()){
			$set[CONEXAO_ativa] = 0;
			#se realmente estiver conectado;
			$r = $this->conexao('ler', "conectado");
			if(isset($r)){
				$this->update("conexao", "(".CONEXAO_ipUsuario." = ".IP_USUARIO.")", $set);
			}
		}#IF checarIntegridade()
	}
	#----------------------------------------------



}
