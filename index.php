<?php 

require_once("config.php");
header("Content-type: application/json");

// carrega 1 usuario

// $root = new Usuario();
// $root->loadById(1);
// echo $root;


//carrega uma lista de usuarios

//echo json_encode(Usuario::getList());


//carrega uma lista de usuarios buscando pelo login

// echo json_encode(Usuario::search("c"));


//carrega um usuário usando login e senha
$usr = new Usuario();

$usr->login("CDG","123123");

echo $usr;

?>