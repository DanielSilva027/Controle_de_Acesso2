<?php
 session_start();

 require_once 'conexao.php';

 if(isset($_POST['btn-cadastrar_disp'])){
    $nome = mysqli_escape_string($connect, $_POST['nome']);
    $numero_serie = mysqli_escape_string($connect, $_POST['numero_serie']);
    $localizacao = mysqli_escape_string($connect, $_POST['localizacao']);

    $sql = "INSERT INTO dispositivo (nome, numero_serie, localizacao)
            VALUES ('$nome','$numero_serie','$localizacao')";
    
    if (mysqli_query($connect, $sql)) {
        $_SESSION['mensagem'] = "Dispositivo cadastro com sucesso!";
        header('Location: menu.php?sucesso');
    } else {
        $_SESSION['mensagem'] = "Erro ao cadastrar no banco de dados!";
        header('Location: menu.php?erroc');
    }


 }
?>