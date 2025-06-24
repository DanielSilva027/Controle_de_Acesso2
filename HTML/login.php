<?php
session_start();
require_once 'conexao.php';

if (isset($_POST['btn-entrar'])) {
    $cpf = mysqli_escape_string($connect, $_POST['cpf']);
    $senha = mysqli_escape_string($connect, $_POST['senha']);
    $senha = base64_encode($senha); // Codificando a senha do mesmo jeito que foi salva no cadastro

  
    $sql = "SELECT id, nome, tipo FROM user WHERE cpf = '$cpf' AND senha = '$senha'";
    $resultado = mysqli_query($connect, $sql);

       if($_SESSION['tipo' == 2]){
         $_SESSION['mensagem'] = "acesso indisponivel";
        header('Location: index.php');
    }
    

    if (mysqli_num_rows($resultado) > 0) {
        $dados = mysqli_fetch_array($resultado);
        $_SESSION['logado'] = true;
        $_SESSION['id_usuario'] = $dados['id'];
        $_SESSION['nome_usuario'] = $dados['nome'];
        header('Location: menu.php');
        exit();
    } else {
        $_SESSION['mensagem'] = "CPF ou Senha incorretos.";
        header('Location: index.php');
    }

}
?>