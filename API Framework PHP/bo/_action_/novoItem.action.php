<?php
#carrega biblioteca;

$bo = new BO();

#usar lib ssession;
//$bo->ssession = new SSession(IP_USUARIO);
#usar lib db;
$bo->db = new DataBase();
#usar lib action;
$bo->action = new Action();

$bo->usuario = new Usuario();

$data = array("nome" => "cleydson Rodrigues",  
              "telefone" => "119374610619".rand(0,11182829929299111264),
              "pin" => cripto("Cr11937461069")
              ); 
              
$bo->db->insert("usuario", $data);