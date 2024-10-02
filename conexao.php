<?php

$servidor = "localhost";
$usuario = "root";
$senha = "";
$dbname = "cadastro_filmes2";

$conn = new mysqli($servidor,$usuario,$senha,$dbname);
if($conn->connect_error){
    die("falha na conexão".$com->connect_error);
}

?>