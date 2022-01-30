<?
/**
 * 
 *          Desenvolvido por: Cleydson Rodrigues

 *  Projeto Framework para APIs
 *
 *  Partes funcionais:
 * base do framework (carregamento de fun??es, classes, actions, database)
 *  Autentica??o.
 *  
 * Parei com o desenvolvimento por aumento da complexidade do sistema.
 * ficaria complexo adicionar mais medidas de seguran?a como CSRF e XSS
e n?o utiliza??o de boas pr?ticas como Namespaces, PSR4 por exemplo.
 */


    include 	"bo/config.php";
    require_once 	"bo/_func_/funcoes.php";
    require_once 	"bo/_class_/classes.php";
    require_once "bo/_action_/action.php";
	require_once "bo/main.php";





