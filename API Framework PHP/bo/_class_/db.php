<?
    /**
     * Classe Database:
     * desenvolvido por: xCRODx
      
      projeto ecommerce com framework próprio.
      uma implementação da classe PDO do php
     * simplifica as querys feitas na DB.
     * podem ser usadas direto nas actions.
     * também podem ser implementada com uma classe usuario separada.
     * Gerencia uma conexão ao fazer login com o usuario
     */

    //namespace DB;

    require_once "config.php";

    class DataBase{
        public $con, $sql;
        function __construct($autoConnect = true){
            /**$this->con = mysqli_connect(DB_HOST, DB_USER, DB_SENHA, DB_NOME);
            if ( mysqli_connect_errno() ) {
                // If there is an error with the connection, stop the script and display the error.
                exit('Failed to connect to MySQL: ' . mysqli_connect_error());
            }
            */

            #evita erros de dupla conexão ao extender a classe DB
            if($autoConnect){
                $this->connect();
            }
        }
        
        function prepare($data){
          
        }

        function connect(){
           
            $this->con = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NOME, DB_USER, DB_SENHA);
        }
        ################BASIC##################################
        function insert($tabela="", $data){
          
          
          
            #pega os dados de index da array e seus respectivos valores e adciona a query
            #depois adciona na DB
            $campos = "(";
            $prepareString = "(";
            //$i = count($data);
            
            $keyIndex=0;
           // $v[0]  = "";
            //$primeiroItem = 0;
            foreach ($data as $key => $value) {
               
                if($keyIndex > 0 ){
                  $campos .= ", "; 
                 // $valores .= ", ";
                  $prepareString .= ", ";
                  
                }
                
                $keyIndex++;
                
                
                
                $campos .= $key;
                
                
                if(isset(SQL_RESERVED_VALUE[$value])){
                  //$bind = array($val
                  $prepareString .= $value;
                 unset($data[$key]);


                }else{
                  $v[]=$value;
                  $prepareString .= ":$key";
                  
               
                }
            }
            $campos .= ")";
            $prepareString .= ")";
            
            $sql = "INSERT INTO $tabela ".$campos ." VALUES".$prepareString;
            
            $q = $this->con->prepare($sql);
         //  for ($i = 0; $i < count($v); $i++) {
         //     $par = $i+1;
         //     $q->bind Param( $par, $v[$i] );
         //  } 
            
          foreach ($data as $c => $val){
          //  $i = 1;
            $q->bindValue(":".$c, $val);
                
          }
            
            try{
              $q->execute();
            }catch(PDOExeption $e){
              
              echo $e->getMessage();
            }

           // return $result;

        }#insert()



        //where pode ser um INNER JOIN
        function select($tabela, $campos="*", $where="", $rowORnum=row, $data=null){
          #select(tabela, campo, condições, tipo de retorno)

            if(!$where == ""){$where = " WHERE $where";}
            if($campos == todos || $campos == ""){$campos = "*";}
            
            $sql = "SELECT $campos FROM $tabela $where";
            $this->con = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NOME, DB_USER, DB_SENHA);
       
            
           $q = $this->con->prepare($sql);
           if($data !== null){
              $indexParam=0;
              foreach ($data as $c => $v){
                $indexParam=1;
                $q->bindValue($indexParam, $v);
              }
            }
            
            try{

              $q->execute();

            }catch(PDOExeption $e){
              
              echo $e->getMessage();
            }
            
            $num = $q->rowCount();
            #se houver ao menos 1 retorno
            if ($num) {
          
                if($rowORnum == "row"){
                 
                    $q = $q->fetchAll();
                    if($num == 1){
                      return $q[0];
                    }else{
                      return $q;
                    }
                }elseif($rowORnum == "num"){
                    return $num;
                }

             } else {
               return false;
             }

        }#select()


        function update($tabela, $where="", $set=array()){
      
            if(!$where == ""){$where = " WHERE ".$where;}

            $virgula = "";
            $campo = "";
         
            $estaNoPrimeiroItem = 0;#nao
          //  $prepareString = "";
            foreach ($set as $key => $value) {
                
                if($estaNoPrimeiroItem > 0 ){
                  $virgula = ", ";
                
                  
                }
                
                $campo .= $virgula;
                $campo .= $key . " = ";
             if(isset(SQL_RESERVED_VALUE[$value]) || is_int($value)){
                    $campo .= $value;
                    unset($set[$key]);
                }else{
                    $campo .= "?";
                 
                }
           
                
                $estaNoPrimeiroItem++;
            }
            $campo .= "";
            $setF = $campo;

            $sql = "UPDATE $tabela SET $setF $where";
            
            $this->con = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NOME, DB_USER, DB_SENHA);
            
           $q = $this->con->prepare($sql);
           if($set !== null){
              $indexParam=0;
              foreach ($set as $c => $v){
                $indexParam++;
                $q->bindValue($indexParam, $v);
                
              }
            }
            
            try{

              $q->execute();
           
            }catch(PDOExeption $e){
              
              echo $e->getMessage();
            }


        }#update()
        
        function delete($tabela, $where){}
        ########################################################


}



    ########## Exemplos de uso ##########
    $tabela = "usuario";
    $db = new Database();
    #-+-+-+-+ INSERT +-+-+-+-+-+
    $u["nome"]="crod";
    $u["telefone"] = 11945594219;
    $u["pin"] = md5("pin");
    $db->insert($tabela,$u);
   #-+-+-+-+-+- Select -+-+-+-+-+-+
    $r = $db->select("usuario", todos, "telefone = 11945594219", row);
 #_---------- update -----------#
    $update["nome"] = "xCRODx";
    $id = $r["id"];
   $db->update("usuario","id = ".$id, $update);
