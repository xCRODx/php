<?
class View{//tpl //comp
    public $actionPage, $data, $comp, $browser;
    private $component;
    
    function __construct(){
        $this->logData = "";
        //$this->con = $con;
        require_once("comp/Componentes.php");
        $this->comp = new Component();
    }

    
    function addComponent($componentNome, $data){
        $com = $this->components[$componentNome] = $data;
        if(file_exists(__DIR__."/".$componentNome."component.php")){
          require_once(__DIR__."/".$componentNome."component.php");
        }else{echo"componente não encontrado";
          
        }
    }

    

}
