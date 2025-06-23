<?php

// Iniciar Sessão
session_start();

// Conexão
require_once 'conexao.php';

if (isset($_POST['btn-cadastrar'])) {
    $cpf = mysqli_escape_string($connect, $_POST['cpf']);
    $nome = mysqli_escape_string($connect, $_POST['nome']);
    $email = mysqli_escape_string($connect, $_POST['email']);
    $telefone = mysqli_escape_string($connect, $_POST['telefone']);
    $tipo = mysqli_escape_string($connect, $_POST['tpc']);
    $senha = mysqli_escape_string($connect, $_POST['senha']);
    $novasenha = base64_encode($senha); 


    // -------- Upload da foto (face) ---------
    $face = $_FILES['face']['name'];                // Nome original da imagem
    $temp = $_FILES['face']['tmp_name'];            // Local temporário

    // Diretório onde a imagem será salva
    $pasta = "../back-end/rostos/";

    // Criar nome único pra evitar sobrescrever imagens
    $novo_nome_face = uniqid() . "-" . $face;

    // Caminho completo
    $destino = $pasta . $novo_nome_face;

    // Move a imagem
    if (move_uploaded_file($temp, $destino)) {
        // Sucesso no upload
    } else {
        $_SESSION['mensagem'] = "Erro ao fazer upload da imagem.";
        header('Location: index.php?erroi');
        exit();
    }

    // -------- Inserção no banco ---------
    $sql = "INSERT INTO user (cpf, nome, email, telefone, tipo, face, senha) 
            VALUES ('$cpf', '$nome', '$email', '$telefone', '$tipo', '$novo_nome_face', '$novasenha')";

    if (mysqli_query($connect, $sql)) {
        $_SESSION['mensagem'] = "Cadastro realizado com sucesso!";
        header('Location: index.php?sucesso');
    } else {
        $_SESSION['mensagem'] = "Erro ao cadastrar no banco de dados!";
        header('Location: index.php?erroc');
    }
}
?>
