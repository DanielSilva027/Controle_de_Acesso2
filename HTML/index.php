<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../accets/CSS/cadastro.css">
</head>
<body>
    <div class="container">
        <h2>Login do Usuário</h2>
        <?php
        if (isset($_SESSION['mensagem'])) {
            echo $_SESSION['mensagem'];
            unset($_SESSION['mensagem']);
        }
        ?>
        <form action="login.php" method="POST">
            <input type="number" name="cpf" placeholder="CPF" required />
            <input type="password" name="senha" placeholder="Senha" required />
            <button type="submit" name="btn-entrar">Entrar</button>
            <button type="button" onclick="window.location.href='cadastro.php'">Cadastrar</button>
        </form>
    </div>
</body>
</html>
