<?php

$servername = "localhost";
$username ="root";
$password = "usbw";
$db_crud = "crud";

$connect = mysql_connect($servername, $username, $password,$db_crud );

if(mysqli_connect_error());
    echo "falha na conexao: ". mysqli_connect_error();
endif;

?>