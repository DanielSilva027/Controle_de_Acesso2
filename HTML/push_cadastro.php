<?php
// Iniciar Sessão
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

// Conexão
require_once 'conexao.php';

if (isset($_POST['btn-cadastrar'])) {
    $cpf      = mysqli_escape_string($connect, $_POST['cpf']);
    $nome     = mysqli_escape_string($connect, $_POST['nome']);
    $email    = mysqli_escape_string($connect, $_POST['email']);
    $telefone = mysqli_escape_string($connect, $_POST['telefone']);
    $tipo     = mysqli_escape_string($connect, $_POST['tpc']);
    $senha    = mysqli_escape_string($connect, $_POST['senha']);
    $novasenha = base64_encode($senha); // criptografia fraca, considere usar password_hash futuramente

    // VERIFICAÇÕES DO UPLOAD DE IMAGEM

    if (!isset($_FILES['face']) || $_FILES['face']['error'] !== 0) {
        $_SESSION['mensagem'] = "Erro ao enviar imagem do rosto.";
        header('Location: index.php?erro_upload');
        exit();
    }

    // Valida tipo MIME
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $tipo_mime = finfo_file($finfo, $_FILES['face']['tmp_name']);
    finfo_close($finfo);

    if (!in_array($tipo_mime, ['image/jpeg', 'image/png'])) {
        $_SESSION['mensagem'] = "Formato de imagem inválido. Envie apenas JPEG ou PNG.";
        header('Location: index.php?erro_tipo');
        exit();
    }

    // UPLOAD DA IMAGEM

    $extensao = pathinfo($_FILES['face']['name'], PATHINFO_EXTENSION); // mantém extensão correta
    $novo_nome_face = uniqid() . '.' . $extensao;
    $pasta = "../rostos/";
    $destino = $pasta . $novo_nome_face;

    if (!move_uploaded_file($_FILES['face']['tmp_name'], $destino)) {
        $_SESSION['mensagem'] = "Erro ao salvar a imagem.";
        header('Location: index.php?erro_mover');
        exit();
    }

    // INSERÇÃO NO BANCO

    $sql = "INSERT INTO user (cpf, nome, email, telefone, tipo, face, senha)
            VALUES ('$cpf', '$nome', '$email', '$telefone', '$tipo', '$novo_nome_face', '$novasenha')";

    if (mysqli_query($connect, $sql)) {
        $_SESSION['mensagem'] = "Cadastro realizado com sucesso!";
        header('Location: index.php?sucesso');
    } else {
        $_SESSION['mensagem'] = "Erro ao cadastrar no banco de dados.";
        header('Location: index.php?erro_banco');
    }
}
?>
