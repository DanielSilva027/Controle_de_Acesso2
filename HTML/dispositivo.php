<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dispositivos</title>
    <link rel="stylesheet" href="../CSS/dispositivo.css" />
  </head>
  <body>
    <div class="container">
      <h1 class="title">Dispositivos</h1>
      <table class="client-table">
        <thead>
          <tr>
            <th>Nome</th>
            <th>Número de Série</th>
            <th>Localização</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody id="device-body">
          <!-- Dispositivos serão inseridos via JavaScript -->
        </tbody>
      </table>
      <button
        class="add-button"
        onclick="window.location.href='cadastro_dispositivo.html'"
      >
        ADICIONAR DISPOSITIVO
      </button>
    </div>

    <script>
      let dispositivos = JSON.parse(localStorage.getItem("dispositivos")) || [
        {
          nome: "Sensor de Temperatura",
          numeroSerie: "SN123456",
          localizacao: "Sala 01",
        },
        {
          nome: "Câmera de Segurança",
          numeroSerie: "SN789012",
          localizacao: "Entrada Principal",
        },
        {
          nome: "Detector de Fumaça",
          numeroSerie: "SN345678",
          localizacao: "Corredor 2",
        },
      ];

      function carregarDispositivos() {
        const tbody = document.getElementById("device-body");
        tbody.innerHTML = "";
        dispositivos.forEach((dispositivo, index) => {
          const tr = document.createElement("tr");

          tr.innerHTML = `
          <td>${dispositivo.nome}</td>
          <td>${dispositivo.numeroSerie}</td>
          <td>${dispositivo.localizacao}</td>
          <td>
            <button class="edit-btn" onclick="editarDispositivo(${index})">✏️</button>
            <button class="delete-btn" onclick="excluirDispositivo(${index})">🗑️</button>
          </td>
        `;

          tbody.appendChild(tr);
        });
      }

      function editarDispositivo(index) {
        alert(
          `Editar dispositivo: ${dispositivos[index].nome} (função ainda não implementada)`
        );
        // Aqui pode abrir um formulário de edição preenchido
      }

      function excluirDispositivo(index) {
        if (
          confirm(`Deseja excluir o dispositivo ${dispositivos[index].nome}?`)
        ) {
          dispositivos.splice(index, 1);
          localStorage.setItem("dispositivos", JSON.stringify(dispositivos));
          carregarDispositivos();
        }
      }

      carregarDispositivos();
    </script>
  </body>
</html>
