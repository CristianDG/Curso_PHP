<?php 

require_once("config.php");

$sql = new Sql();

$users = $sql->select("SELECT * FROM tb_usuario");

header("Content-type: application/json");
echo json_encode($users);


?>