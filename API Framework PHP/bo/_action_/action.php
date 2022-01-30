<?php
//$bo = new BO();
### As actions são Scripts que executam ações especificas do sistema a ser desenvolvido.
#É carregado ao incidir a query &action=nomeDaAction na url
# essa classe tem acesso aos dafos vindos via Post e Get

class Action{
    public $actionPage;
    public $post, $logData;
    private $con;
    function __construct(){
        $this->logData = "";
        //$this->con = $con;
        if($this->get("action")){
            $action = $this->get("action");
            require_once $action.".action.php";
        }elseif($this->get("action")) {
            $action = $this->get("action");
            require_once $action.".action.php";
        }else{
            //require_once "index.action.php";
        }
    }

    #retorna se a comparação das datas é verdadeira ou falsa
    function tempo($data, $metrica){
        return true;
    }

    function goAction($location, $get = false ){
        $s = "?";
        if($get !== false){
            
            foreach($get as $key => $value){
                $s.= "&".$key."=".$value;
            }
            
        }
        header('Location: '.$location.$s);
    }

    function get($k,$con = false){#ler dados do Get
        //$con = $this->con;
        if(isset($_GET[$k])){
            if(!$con == false){
                echo "con";
                return ($_GET[$k]);
            }else{
                return $_GET[$k];
            }
            
        }else{return false;}
    }

    public function post($k, $con = false){#ler dados do Post
        //$con = $this->con;
        if(isset($_POST[$k])){
            if(!$con == false){
                
                return ($_POST[$k]);
            }else{
                return $_POST[$k];
            }
        }else{return false;}
    }#post()

    function enviar($msg){
        echo encrypt(json_encode($msg));
    }#enviar()

    function log($l){
        $this->logData .="<p>$l</p><br>";
    }



    function loadAction(){

        /*foreach($_GET as $key => $value){
            echo $this->get($key);
        }
        */

        //require_once "add_usuario.action.php";
        /*if(isset($_GET["action"])){
            $action = $_GET["action"];
            require_once $action.".action.php";
        }elseif(isset($_POST["action"])) {
            $action = $_POST["action"];
            require_once $action.".action.php";
        }else{
            require_once "index.action.php";
        }
        */
        if($this->get("action")){
            $action = $this->get("action");
            require_once $action.".action.php";
        }elseif($this->get("action")) {
            $action = $this->get("action");
            require_once $action.".action.php";
        }else{
            //require_once "index.action.php";
        }
    }#loadAction()

}