<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="../accets/CSS/cadastro.css" />
  </head>
  <body>
    <div class="container">
      <h2>Cadastro de Usuário</h2>
      <input type="text" id="cpf" placeholder="CPF (chave primária)" />
      <input type="text" id="nome" placeholder="Nome completo" />
      <input type="email" id="email" placeholder="E-mail" />
      <input type="text" id="telefone" placeholder="Telefone" />
      <select id="tpc">
        <option value="">Selecione o tipo de conta</option>
        <option value="Admin">Admin</option>
        <option value="Usuario">Usuário</option>
      </select>

      <!-- Alterado: input de upload de imagem -->
      <label for="face">Foto (Face ID):</label>
      <input type="file" id="face" accept="image/*" />

      <input type="password" id="senha" placeholder="Senha de Acesso" />
      <button onclick="cadastrarUsuario()">Cadastrar</button>
      <button onclick="window.location.href='index.php'">Voltar</button>
    </div>

    <script>
      function cadastrarUsuario() {
        const cpf = document.getElementById("cpf").value.trim();
        const nome = document.getElementById("nome").value.trim();
        const email = document.getElementById("email").value.trim();
        const telefone = document.getElementById("telefone").value.trim();
        const tpc = document.getElementById("tpc").value.trim();
        const faceInput = document.getElementById("face");
        const senha = document.getElementById("senha").value.trim();

        if (!cpf || !nome || !email || !telefone || !senha) {
          alert("Por favor, preencha todos os campos obrigatórios.");
          return;
        }

        if (!faceInput.files.length) {
          alert("Por favor, selecione uma imagem para Face ID.");
          return;
        }

        const faceFile = faceInput.files[0];
        const faceFileName = faceFile.name;

        let usuarios =
          JSON.parse(localStorage.getItem("usuariosCadastrados")) || [];

        if (usuarios.some((u) => u.cpf === cpf)) {
          alert("Já existe um usuário com este CPF.");
          return;
        }

        const novoUsuario = {
          cpf,
          nome,
          email,
          telefone,
          tpc,
          face: faceFileName, // Apenas o nome da imagem
          senha,
        };

        usuarios.push(novoUsuario);
        localStorage.setItem("usuariosCadastrados", JSON.stringify(usuarios));

        alert("Usuário cadastrado com sucesso!");

        localStorage.setItem("usuarioLogadoCPF", cpf);
        window.location.href = "menu.php";
      }
    </script>
  </body>
</html>