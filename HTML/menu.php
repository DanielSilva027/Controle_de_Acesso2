<?php
session_start();
include('conexao.php');

$nomeUsuarioLogado = $_SESSION['nome_usuario'] ?? 'Usuário não identificado';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Painel Administrativo</title>
  <link rel="stylesheet" href="../accets/CSS/menu.css">
</head>
<body>
  <div class="main-container">
    <div class="top-bar">
      <span class="menu-text">Painel Administrativo</span>
      <span class="logged-user">Usuário Logado: <?php echo htmlspecialchars($nomeUsuarioLogado); ?></span>
      <button class="logout-button" onclick="window.location.href='logout.php'">Sair</button>
    </div>

    <div class="content-area">
      <div class="left-pane">
        <a href="?pagina=usuarios"><button class="nav-button">👤 Gerenciar Usuários</button></a>
        <a href="?pagina=dispositivos"><button class="nav-button">💻 Dispositivos</button></a>
        <a href="?pagina=notificacoes"><button class="nav-button">🔔 Notificações</button></a>
      </div>

      <div class="right-content">
        <?php
        include('conexao.php');
        $pagina = $_GET['pagina'] ?? 'home';

        if ($pagina === 'usuarios') {
          echo '<h2>Lista de Usuários</h2>';
          $res = mysqli_query($connect, "SELECT * FROM user ORDER BY nome ASC");
          if (!$res) {
            echo "<p>Erro: " . mysqli_error($connect) . "</p>";
          } else {
            echo '<div class="user-module-container container">';
            echo '<table class="user-module-table">';
            echo '<thead><tr><th>CPF</th><th>Nome</th><th>Email</th><th>Telefone</th><th>Face</th><th>Ações</th></tr></thead><tbody>';
            while ($u = mysqli_fetch_assoc($res)) {
              echo "<tr>
                <td>{$u['cpf']}</td>
                <td>{$u['nome']}</td>
                <td>{$u['email']}</td>
                <td>{$u['telefone']}</td>
                <td>{$u['face']}</td>
                <td><a href='editar_usuario.php?id={$u['id']}'>✏️</a> <a href='deletar.php?id={$u['id']}' onclick='return confirm(\"Excluir?\")'>🗑️</a></td>
              </tr>";
            }
            echo '</tbody></table>';
            echo '<button onclick="window.location.href=\'adicionarusuario.php\'">➕ Adicionar Novo Usuário</button>';
            echo '</div>';
          }
        } elseif ($pagina === 'dispositivos') {
          echo '<h2>Lista de Dispositivos</h2>';
          $res = mysqli_query($connect, "SELECT * FROM dispositivo ORDER BY nome ASC");
          if (!$res) {
            echo "<p>Erro: " . mysqli_error($connect) . "</p>";
          } else {
            echo '<div class="user-module-container container">';
            echo '<table class="user-module-table">';
            echo '<thead><tr><th>ID</th><th>Nome</th><th>Nº de Série</th><th>Localização</th><th>Ações</th></tr></thead><tbody>';
            while ($d = mysqli_fetch_assoc($res)) {
              echo "<tr>
                <td>{$d['id']}</td>
                <td>{$d['nome']}</td>
                <td>{$d['n_de_serie']}</td>
                <td>{$d['localizacao']}</td>
                <td><a href='editar_dispositivo.php?id={$d['id']}'>✏️</a> <a href='deletar_dispositivo.php?id={$d['id']}' onclick='return confirm(\"Excluir?\")'>🗑️</a></td>
              </tr>";
            }
            echo '</tbody></table>';
            echo '<button onclick="window.location.href=\'cadastro_dispositivo.php\'">➕ Adicionar Novo Dispositivo</button>';
            echo '</div>';
          }
        } elseif ($pagina === 'notificacoes') {
          echo '<h2>Lista de Notificações</h2>';
          $res = mysqli_query($connect, "SELECT * FROM notificacao ORDER BY data_hora DESC");
          if (!$res) {
            echo "<p>Erro: " . mysqli_error($connect) . "</p>";
          } else {
            echo '<div class="user-module-container container">';
            echo '<table class="user-module-table">';
            echo '<thead><tr><th>ID</th><th>Dispositivo</th><th>Face</th><th>Nome</th><th>Data/Hora</th></tr></thead><tbody>';
            while ($n = mysqli_fetch_assoc($res)) {
              echo "<tr>
                <td>{$n['id']}</td>
                <td>{$n['dispositivo']}</td>
                <td>{$n['face']}</td>
                <td>{$n['nome']}</td>
                <td>{$n['data_hora']}</td>
              </tr>";
            }
            echo '</tbody></table>';
            echo '</div>';
          }
        } else {
          echo '<p style="padding: 20px; font-style: italic; color: #ccc;">Selecione uma opção no menu para começar.</p>';
        }
        ?>
      </div>
    </div>
  </div>
</body>
</html>
