<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Cadastro de Dispositivo</title>
    <link rel="stylesheet" href="../accets/CSS/cadastro.css" />
  </head>
  <body>
    <div class="container">
      <h2>Cadastro de Dispositivo</h2>

      <input type="text" id="nome" placeholder="Nome do dispositivo" />
      <input type="text" id="numeroSerie" placeholder="Número de Série" />
      <input type="text" id="localizacao" placeholder="Localização" />

      <button onclick="cadastrarDispositivo()">Cadastrar</button>
      <button onclick="window.location.href='menu.php'">Voltar</button>
    </div>

    <script>
      function cadastrarDispositivo() {
        const nome = document.getElementById("nome").value.trim();
        const numeroSerie = document.getElementById("numeroSerie").value.trim();
        const localizacao = document.getElementById("localizacao").value.trim();

        if (!nome || !numeroSerie || !localizacao) {
          alert("Por favor, preencha todos os campos.");
          return;
        }

        let dispositivos =
          JSON.parse(localStorage.getItem("dispositivos")) || [];

        // Verifica se o número de série já existe
        if (dispositivos.some((d) => d.numeroSerie === numeroSerie)) {
          alert(
            "Já existe um dispositivo cadastrado com este número de série."
          );
          return;
        }

        dispositivos.push({ nome, numeroSerie, localizacao });
        localStorage.setItem("dispositivos", JSON.stringify(dispositivos));

        alert("Dispositivo cadastrado com sucesso!");
        window.location.href = "menu.php"; // volta para lista após cadastro
      }
    </script>
  </body>
</html>
