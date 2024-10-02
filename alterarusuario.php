<?php
include("conexao.php");

$cpf = $_POST["cpf"];
$nome = $_POST["nome"];
$senha = $_POST["senha"]; 
$cpfanterior = $_POST["cpfanterior"];

$sql = "update usuarios set cpf = '$cpf', 
                            senha = '$senha',
                            nome = '$nome' 
                            where cpf = '$cpfanterior'";

if(!$resultado = $conn->query($sql)){
    die("erro");
}
header("Location: cadastrarusuarios.php");

