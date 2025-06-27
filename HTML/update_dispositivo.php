<?php
require_once 'conexao.php';
session_start();

if (isset($_POST['id'])) {
  $id = intval($_POST['id']);
  $nome = mysqli_escape_string($connect, $_POST['nome']);
  $numero_serie = mysqli_escape_string($connect, $_POST['numero_serie']);
  $localizacao = mysqli_escape_string($connect, $_POST['localizacao']);

  $sql = "UPDATE dispositivo 
          SET nome = '$nome', n_de_serie = '$numero_serie', localizacao = '$localizacao' 
          WHERE id = $id";

  if (mysqli_query($connect, $sql)) {
    $_SESSION['mensagem'] = "Dispositivo atualizado com sucesso!";
    header('Location: menu.php?pagina=dispositivos&sucesso');
  } else {
    $_SESSION['mensagem'] = "Erro ao atualizar dispositivo.";
    header('Location: menu.php?pagina=dispositivos&erro');
  }
} else {
  echo "Requisição inválida.";
}
?>
