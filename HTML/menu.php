<?php
session_start();
if (!isset($_SESSION['logado'])) {
    header('Location: index.php');
    exit();
}

$nome_usuario = $_SESSION['nome_usuario'];
?>

<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Menu</title>
    <link rel="stylesheet" href="../accets/CSS/menu.css" />
  </head>

  <body>
    <div class="main-container">
      <div class="top-bar">
        <span class="menu-text">Menu</span>
        <span class="logged-user">
          Usuário Logado: <?php echo htmlspecialchars($nome_usuario); ?>
        </span>
        <button class="logout-button" onclick="window.location.href='logout.php'">Sair</button>
      </div>

      <div class="content-area">
        <div class="left-pane">
          <button class="nav-button" id="manage-users-button">
            <img src="../accets/IMAGEM/gusuarios.png" alt="Gerenciar Usuários" class="nav-icon" />
            Gerenciar Usuários
          </button>

          <button class="nav-button" id="manage-devices-button">
            <img src="../accets/IMAGEM/gdispositivos-removebg-preview.png" alt="Gerenciar Dispositivos" class="nav-icon" />
            Gerenciar Dispositivos
          </button>

          <button class="nav-button" id="records-button">
            <img src="../accets/IMAGEM/registros.png" alt="Registros" class="nav-icon" />
            Registros
          </button>
        </div>

        <div class="right-content" id="right-content-area">
          <p style="padding: 20px; color: #666; font-style: italic;">
            Selecione uma opção no menu para começar.
          </p>
        </div>
      </div>
    </div>

    <script>
      const rightContentArea = document.getElementById("right-content-area");

      function setActiveButton(buttonToActivate) {
        document.querySelectorAll(".nav-button").forEach((button) => {
          button.classList.remove("active");
        });
        buttonToActivate.classList.add("active");
      }

      function limparSelecao() {
        document.querySelectorAll(".nav-button").forEach((button) => {
          button.classList.remove("active");
        });
        rightContentArea.innerHTML = `
          <p style="padding: 20px; color: #666; font-style: italic;">
            Selecione uma opção no menu para começar.
          </p>
        `;
      }

      document.addEventListener("DOMContentLoaded", () => {
        document.getElementById("manage-users-button").addEventListener("click", (event) => {
          setActiveButton(event.target.closest("button"));
          showUsersTable();
        });

        document.getElementById("manage-devices-button").addEventListener("click", (event) => {
          setActiveButton(event.target.closest("button"));
          showDevicesTable();
        });

        document.getElementById("records-button").addEventListener("click", (event) => {
          setActiveButton(event.target.closest("button"));
          showNotificationsTable();
        });

        limparSelecao();
      });

      function showUsersTable() {
        rightContentArea.innerHTML = `
          <div class="user-module-container container">
            <h1>Lista de Usuários</h1>
            <table class="user-module-table">
              <thead>
                <tr>
                  <th>CPF</th>
                  <th>Nome</th>
                  <th>Email</th>
                  <th>Telefone</th>
                  <th>Tipo de Conta</th>
                  <th>Face ID</th>
                  <th>Ações</th>
                </tr>
              </thead>
              <tbody id="user-body">
                <!-- Dados do backend futuramente -->
              </tbody>
            </table>
            <button class="action-button">Ordenar por Nome (A-Z)</button>
            <button class="action-button" onclick="window.location.href='adicionarusuario.php'">
              ➕ Adicionar Novo Usuário
            </button>
          </div>
        `;
      }

      function showDevicesTable() {
        rightContentArea.innerHTML = `
          <div class="user-module-container container">
            <h1>Lista de Dispositivos</h1>
            <table class="user-module-table">
              <thead>
                <tr>
                  <th>Nome</th>
                  <th>Localização</th>
                  <th>Modelo</th>
                  <th>Ações</th>
                </tr>
              </thead>
              <tbody id="device-body">
                <!-- Dados do backend futuramente -->
              </tbody>
            </table>
            <button class="action-button">Ordenar por Nome (A-Z)</button>
            <button class="action-button" onclick="window.location.href='dispositivo.php'">
              ➕ Adicionar Novo Dispositivo
            </button>
          </div>
        `;
      }

      function showNotificationsTable() {
        rightContentArea.innerHTML = `
          <div class="user-module-container container">
            <h1>Registros</h1>
            <table class="user-module-table">
              <thead>
                <tr>
                  <th>CPF</th>
                  <th>Nome</th>
                  <th>Tipo</th>
                  <th>Data/Hora</th>
                </tr>
              </thead>
              <tbody id="records-body">
                <!-- Dados do backend futuramente -->
              </tbody>
            </table>
          </div>
        `;
      }
    </script>
  </body>
</html>
