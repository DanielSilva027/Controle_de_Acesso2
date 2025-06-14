<?php

$servername = "localhost";
$username = "root";
$password = "serra";
$dbname = "smartcam";

// Criando conexão
$connect = mysqli_connect($servername, $username, $password, $dbname);

// Verificando conexão
if (!$connect) {
    die("Falha na conexão: " . mysqli_connect_error());
} else {
    echo "Conexão bem-sucedida!";
}

?>
