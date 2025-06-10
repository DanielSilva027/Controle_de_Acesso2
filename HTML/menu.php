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
        <span class="logged-user" id="logged-user">Usuário Logado</span>
        <button id="logout-button" class="logout-button">Sair</button>
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
      let usuarios = JSON.parse(localStorage.getItem("usuariosCadastrados")) || [];
      let dispositivos = JSON.parse(localStorage.getItem("dispositivosCadastrados")) || [];
      let registros = JSON.parse(localStorage.getItem("registrosSalvos")) || [];
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
        const cpf = localStorage.getItem("usuarioLogadoCPF");
        const loggedUserElem = document.getElementById("logged-user");

        if (cpf && loggedUserElem) {
          const user = usuarios.find(u => u.cpf === cpf);
          if (user && user.nome) {
            loggedUserElem.textContent = `Usuário Logado: ${user.nome}`;
          } else {
            loggedUserElem.textContent = `Usuário não encontrado (CPF ${cpf})`;
          }
        }

        const manageUsersButton = document.getElementById("manage-users-button");
        const manageDevicesButton = document.getElementById("manage-devices-button");
        const recordsButton = document.getElementById("records-button");

        manageUsersButton.addEventListener("click", () => {
          setActiveButton(manageUsersButton);
          showUsersTable();
        });

        manageDevicesButton.addEventListener("click", () => {
          setActiveButton(manageDevicesButton);
          showDevicesTable();
        });

        recordsButton.addEventListener("click", () => {
          setActiveButton(recordsButton);
          showNotificationsTable();
        });

        limparSelecao();
      });

      // ---------------------- Usuários -----------------------
      function carregarUsuarios() {
        const tbody = document.getElementById("user-body");
        if (!tbody) return;
        tbody.innerHTML = "";
        usuarios.forEach((user, index) => {
          const tr = document.createElement("tr");
          tr.innerHTML = `
            <td>${user.cpf || ""}</td>
            <td>${user.nome || ""}</td>
            <td>${user.email || ""}</td>
            <td>${user.telefone || ""}</td>
            <td>${user.tpc || ""}</td>
            <td>${user.face ? `<img src="/accets/IMAGEM/${user.face}" alt="Foto" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">` : "N/A"}</td>
            <td>
              <button onclick="editarUsuario(${index})">✏️</button>
              <button onclick="excluirUsuario(${index})">🗑️</button>
            </td>
          `;
          tbody.appendChild(tr);
        });
      }

      // MODIFICADO: Redireciona para edita.php com o tipo de entidade e o índice
      function editarUsuario(index) {
        // We don't need to get the user here, just pass the index
        window.location.href = `edita.php?type=user&index=${index}`;
      }

      function excluirUsuario(index) {
        if (confirm(`Deseja excluir o usuário ${usuarios[index].nome}?`)) {
          usuarios.splice(index, 1);
          localStorage.setItem("usuariosCadastrados", JSON.stringify(usuarios));
          carregarUsuarios();
        }
      }

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
              <tbody id="user-body"></tbody>
            </table>
            <button class="action-button" onclick="sortAlphabeticallyUsuarios()">Ordenar por Nome (A-Z)</button>
            <button class="action-button" onclick="window.location.href='adicionarusuario.php'">
              ➕ Adicionar Novo Usuário
            </button>
          </div>
        `;
        carregarUsuarios();
      }

      function sortAlphabeticallyUsuarios() {
        usuarios.sort((a, b) => (a.nome || "").toLowerCase().localeCompare((b.nome || "").toLowerCase()));
        localStorage.setItem("usuariosCadastrados", JSON.stringify(usuarios));
        carregarUsuarios();
      }

      // REMOVIDO ou NÃO CHAMADO: A função showEditForm não é mais chamada pelo editarUsuario
      // Sua lógica de edição agora estará em edita.php
      // function showEditForm(user, index) { /* ... */ }

      // REMOVIDO ou NÃO CHAMADO: A função showCadastroForm não é mais chamada pelo botão de adicionar
      // A lógica de cadastro agora estará em adicionarusuario.php
      // function showCadastroForm() { /* ... */ }

      // ---------------------- Dispositivos -----------------------
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
              <tbody id="device-body"></tbody>
            </table>
            <button class="action-button" onclick="sortDevicesAlphabetically()">Ordenar por Nome (A-Z)</button>
            <button class="action-button" onclick="window.location.href='cadastro_dispositivo.php'">
              ➕ Adicionar Novo Dispositivo
            </button>
          </div>
        `;
        carregarDispositivos();
      }

      function carregarDispositivos() {
        const tbody = document.getElementById("device-body");
        if (!tbody) return;
        tbody.innerHTML = "";
        dispositivos.forEach((device, index) => {
          const tr = document.createElement("tr");
          tr.innerHTML = `
            <td>${device.nome}</td>
            <td>${device.localizacao}</td>
            <td>${device.modelo}</td>
            <td>
              <button onclick="editarDispositivo(${index})">✏️</button>
              <button onclick="excluirDispositivo(${index})">🗑️</button>
            </td>
          `;
          tbody.appendChild(tr);
        });
      }

      function sortDevicesAlphabetically() {
        dispositivos.sort((a, b) => (a.nome || "").toLowerCase().localeCompare((b.nome || "").toLowerCase()));
        localStorage.setItem("dispositivosCadastrados", JSON.stringify(dispositivos));
        carregarDispositivos();
      }

      // MODIFICADO: Redireciona para edita.php com o tipo de entidade e o índice
      function editarDispositivo(index) {
        // We don't need to get the device here, just pass the index
        window.location.href = `edita.php?type=device&index=${index}`;
      }

      function excluirDispositivo(index) {
        if (confirm(`Deseja excluir o dispositivo ${dispositivos[index].nome}?`)) {
          dispositivos.splice(index, 1);
          localStorage.setItem("dispositivosCadastrados", JSON.stringify(dispositivos));
          carregarDispositivos();
        }
      }

      // REMOVIDO ou NÃO CHAMADO: A função showCadastroDispositivoForm não é mais chamada pelo botão de adicionar
      // A lógica de cadastro agora estará em cadastro_dispositivo.php
      // function showCadastroDispositivoForm() { /* ... */ }


      // ---------------------- Registros -----------------------
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
              <tbody id="records-body"></tbody>
            </table>
          </div>
        `;
        carregarRegistros();
      }

      function carregarRegistros() {
        const tbody = document.getElementById("records-body");
        if (!tbody) return;
        tbody.innerHTML = "";
        registros.forEach((registro) => {
          const tr = document.createElement("tr");
          tr.innerHTML = `
            <td>${registro.cpf}</td>
            <td>${registro.nome}</td>
            <td>${registro.tipo}</td>
            <td>${registro.dataHora}</td>
          `;
          tbody.appendChild(tr);
        });
      }

      const logoutButton = document.getElementById("logout-button");
      logoutButton.addEventListener("click", () => {
        if (confirm("Tem certeza que deseja sair?")) {
          localStorage.removeItem("usuarioLogadoCPF");
          window.location.href = "../HTML/index.php";
        }
      });
    </script>
  </body>
</html>