<?
//namespace  BrasOn\App;
//$bo = new BO();
if(true){
    class SSession{
        public $started;
        function __construct($ip, $autoStart = true){
            if(isset($_SESSION) || (session_status() !== PHP_SESSION_ACTIVE)){

                if($autoStart==true){@session_start();}

                if(!$this->get('IP')){
                    $this->set('IP', IP_USUARIO);
                     //echo "nao tem ipUsuario ";
                 }
            }
        }

        function start(){
            session_start();
            //$this->started = true;

        }

        #adiciona uma sessão com o valor e a chave encriptada
        function set($k, $v){
            $k = encrypt(cripto(CHAVE_SEGURA.$k));
            $_SESSION[$k] = encrypt($v);
        }

        #pega uma sessão encriptada
        function get($k){
            $k = encrypt(cripto(CHAVE_SEGURA.$k)); 
            if(isset($_SESSION[$k])){
                return decrypt($_SESSION[$k]);
            }else{return false;}
        
        }


        #checa integridade dos cookies, se a sessão do ip foi iniciada nessa maquina, ou foi copiada;
        function checarIntegridade(){
            if(IP_USUARIO == $this->get("IP")){
                return true;
            }//elseif(DEV){return true;}#se estiver em DEV facilita os teste da função
        }
        function dadosLogin(){
            $l = "LoginUsuario";
            $data['pin'] = $this->get($l.'pin');
            $data['username'] = $this->get($l.'username');
            return $data;
        }

        function destroy(){
            session_destroy();
        }

    }
}