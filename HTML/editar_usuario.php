<?php
require_once 'conexao.php';

if (!isset($_GET['id'])) {
  die("Usuário não especificado.");
}

$id = intval($_GET['id']);
$res = mysqli_query($connect, "SELECT * FROM user WHERE id = $id");
$user = mysqli_fetch_assoc($res);

if (!$user) {
  die("Usuário não encontrado.");
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Editar Usuário</title>
  <link rel="stylesheet" href="../accets/CSS/cadastro.css">
</head>
<body>
  <div class="container">
    <h2>Editar Usuário</h2>
    <form action="update_usuario.php" method="POST">
      <input type="hidden" name="id" value="<?= $user['id'] ?>">
      <input type="text" name="cpf" value="<?= $user['cpf'] ?>" placeholder="CPF" required>
      <input type="text" name="nome" value="<?= $user['nome'] ?>" placeholder="Nome" required>
      <input type="email" name="email" value="<?= $user['email'] ?>" placeholder="Email" required>
      <input type="text" name="telefone" value="<?= $user['telefone'] ?>" placeholder="Telefone" required>
      <input type="text" name="face" value="<?= $user['face'] ?>" placeholder="Face">
      <button type="submit">Salvar Alterações</button>
      <button type="button" onclick="window.location.href='menu.php?pagina=usuarios'">Voltar</button>
    </form>
  </div>
</body>
</html>
