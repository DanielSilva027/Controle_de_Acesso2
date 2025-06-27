<?php
session_start();
require_once 'conexao.php';

// Ativa exibição de erros
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['btn-cadastrar_disp'])) {
    $nome = mysqli_escape_string($connect, $_POST['nome']);
    $numero_serie = mysqli_escape_string($connect, $_POST['numero_serie']);
    $localizacao = mysqli_escape_string($connect, $_POST['localizacao']);

    // CORREÇÃO: nome da coluna correto é n_de_serie
    $sql = "INSERT INTO dispositivo (nome, n_de_serie, localizacao)
            VALUES ('$nome','$numero_serie','$localizacao')";

    if (mysqli_query($connect, $sql)) {
        $_SESSION['mensagem'] = "Dispositivo cadastrado com sucesso!";
        header('Location: menu.php?pagina=dispositivos');
    } else {
        $_SESSION['mensagem'] = "Erro ao cadastrar no banco de dados!";
        header('Location: menu.php?pagina=dispositivos&erro=1');
    }
}
