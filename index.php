<?php 

require_once("config.php");

$root = new Usuario();

$root->loadById(1);

header("Content-type: application/json");
echo $root;

?>