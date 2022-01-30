<?php
    define("IP_USUARIO" ,$_SERVER["REMOTE_ADDR"]);
    define("CHAVE_SEGURA","Chave segura para encriptorafia da sessão. h2o Co2 o2 h2");
    define("DEV",true);
    define("API_KEY", "chave para liberar acesso ao aplicativo");
    
    #@-------------- Pastas -----------
    define("SITE",		    "localhost/bo/bo/");
    define("CLASS_FOLDER",	"_class_/");
    define("FUNC_FOLDER",	"_func_/");
    #------------------------------------

	################## DATA ##############
	define('ANOS',      31536000);	# * 365
	define('MESES',     2592000);	# * 30
	define('SEMANAS',   604800);	# * 7
    define('DIAS',      86400);		# * 24
    define('HORAS',     3600);		# * 60
    define('MINUTOS',   60);		# * 60
    define('SEGUNDOS',  1);		    # * 1
    define("AGORA", date('d/m/Y H:i'));
	######################################

    
    #############  DataBase ###############
	#--------------- AUTH -----------------
        define("DB_NOME",   "brShopDB");
        define("DB_HOST",   "0.0.0.0:3306");
        define("DB_USER",   "root");
        define("DB_SENHA",  "root");
        define("PREFIX",    "");
	#--------------------------------------

    #======================== CAMPOS E TABELAS ==============================
        define("DB_TABELA_USUARIO", 'usuario');#-----------------------------
            define("USUARIO_nome",                'nome');
            define("USUARIO_telefone",            'telefone');
            define("USUARIO_pin",                 'pin');
            define("USUARIO_id",                  'id');
        
        define("DB_TABELA_LOJA", 'loja');#------------------------------------

        define("DB_TABELA_ITEM", 'item');#------------------------------------

        define("DB_TABELA_CONEXAO", 'conexao');
            define("CONEXAO_ativa",               'ativa');
            define("CONEXAO_ipUsuario",           'ipUsuario');
            define("CONEXAO_dataAcessoCriado",    'dataAcessoCriado');
            define("CONEXAO_usuarioSID",          'usuarioSID');
            define("CONEXAO_ultimoAcesso",        'ultimoAcesso');
            define("CONEXAO_nome",                'nome');

       
    #=========================================================================

        ## facilitadores
        define("todos", "*");
        define("row",   "row");
        define("num",   "num");

        define("newline","<br>");

         #-.-.-.-.-.-.-.-.-. SQL .-.-.-.-.-.-.-.-.-.-.-.-.-
            //palavras reservadas do SQL
            define("SQL_RESERVED_VALUE", array());
        #-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-







    $lang = array('pt-br' => '' );

    #################  RESPOSTA ###################
    define("MSG_USUARIO_CRIADO", "Usuario Criado");
    define("MSG_USUARIO_LOGADO", "Usuario logado");
    define("MSG_USUARIO_NAO_LOGADO", "Usuario não está logado");

    define("MSG_CONSULTA_SUCESSO", "Consulta realizada com sucesso");

    #--------------------------- errors ---------------------------
    define("ERROR_USUARIO_EXISTE", "Erro: Usuario já existe!");
    define("ERROR_USUARIO_LOGADO", "Erro: Usuario ainda está logado!");

    define("ERROR_CONEXAO_EXISTE", "Erro: Conexao já existe");
    define("ERROR_CONEXAO_CRIAR", "Erro: inesperado ao criar conexão");


    define("ERROR_CREDENCIAIS_INCORRETAS", "Erro: Credenciais incorretas");
    
    define("ERROR_CONSULTA_FALHOU", "Erro: Consulta falhou");
    #---------------------------------------------------------------
    
