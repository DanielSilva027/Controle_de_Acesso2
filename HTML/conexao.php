<?php

$servername = "localhost";
$username = "root";
$password = "serra";
$db_crud = "smartcam";

// Cria a conexão
$connect = mysqli_connect($servername, $username, $password, $db_crud);

// Verifica se houve erro na conexão
if ( mysqli_connect_error()) {
    echo "Falha na conexão: " . mysqli_connect_error();
}

?>