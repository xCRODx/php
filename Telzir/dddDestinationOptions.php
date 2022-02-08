  <?php
  /*
    *This script return as a template component all DDD destination that match with a DDD origin
  */
  
  require_once("db.php");
  require_once("template.php");
  
  class dddDestinationOptions extends Template{
    
    public function __construct($dddOrigin){
      
      //$ddds has all DDD destinations that match with dddOrigin
      $ddds = getAvailableDDD($dddOrigin);
      
      $options = "";
      //echo json_encode($ddds);
      for ($i = 0; $i < count($ddds); $i++) {
         $ddd = $ddds[$i];
         foreach ($ddd as $key => $value){
          // var_dump($ddd);
           $options .= "<option value='".$value."'>$value</option>";
         }
      }
    //  var_dump( $options );
      $data["dddDestinationOption"] = $options;
    //var_dump($data);
      $this->component = $this->load("dddDestinationOptions", $data);
      //var_dump($this->component);
    }
  }
  
/* 
  when its a post request
*/
$getDDD = isset($_POST["getDDD"]) ? true : false;
$dddOrigin = isset($_POST["dddOrigin"]) ? $_POST["dddOrigin"] : false;

if($getDDD && $dddOrigin ){
  $opt = new dddDestinationOptions($dddOrigin);
  echo $opt->component;
}