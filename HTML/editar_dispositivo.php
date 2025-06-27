<?php
require_once 'conexao.php';
session_start();

if (!isset($_GET['id'])) {
  die("Dispositivo não especificado.");
}

$id = intval($_GET['id']);
$res = mysqli_query($connect, "SELECT * FROM dispositivo WHERE id = $id");
$disp = mysqli_fetch_assoc($res);

if (!$disp) {
  die("Dispositivo não encontrado.");
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Editar Dispositivo</title>
  <link rel="stylesheet" href="../accets/CSS/cadastro.css">
</head>
<body>
  <div class="container">
    <h2>Editar Dispositivo</h2>
    <form action="update_dispositivo.php" method="POST">
      <input type="hidden" name="id" value="<?= $disp['id'] ?>">
      <input type="text" name="nome" value="<?= $disp['nome'] ?>" placeholder="Nome do dispositivo" required>
      <input type="number" name="numero_serie" value="<?= $disp['n_de_serie'] ?>" placeholder="Número de série" required>
      <input type="text" name="localizacao" value="<?= $disp['localizacao'] ?>" placeholder="Localização" required>
      <button type="submit">Salvar Alterações</button>
      <button type="button" onclick="window.location.href='menu.php?pagina=dispositivos'">Voltar</button>
    </form>
  </div>
</body>
</html>
