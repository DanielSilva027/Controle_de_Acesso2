<?php

$servername = "localhost";
$username = "root";
$password = "usbw";
$dbname = "smartcam";

// Criando conexão
$connect = mysqli_connect($servername,$username, $password, $dbname,3306 );

// Verificando conexão
if (!$connect) {
    die("Falha na conexão: " . mysqli_connect_error());
} else {
}

?>
