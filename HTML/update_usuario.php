<?php
require_once 'conexao.php';

if (isset($_POST['id'])) {
  $id = intval($_POST['id']);
  $cpf = mysqli_escape_string($connect, $_POST['cpf']);
  $nome = mysqli_escape_string($connect, $_POST['nome']);
  $email = mysqli_escape_string($connect, $_POST['email']);
  $telefone = mysqli_escape_string($connect, $_POST['telefone']);
  $face = mysqli_escape_string($connect, $_POST['face']);

  $sql = "UPDATE user 
          SET cpf = '$cpf', nome = '$nome', email = '$email', telefone = '$telefone', face = '$face' 
          WHERE id = $id";

  if (mysqli_query($connect, $sql)) {
    $_SESSION['mensagem'] = "Usuário atualizado com sucesso!";
    header('Location: menu.php?pagina=usuarios&sucesso');
  } else {
    $_SESSION['mensagem'] = "Erro ao atualizar usuário.";
    header('Location: menu.php?pagina=usuarios&erro');
  }
} else {
  echo "Requisição inválida.";
}
?>
