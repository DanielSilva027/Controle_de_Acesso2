<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="../accets/CSS/cadastro.css" />
  </head>
  <body>
    <div class="container">
      <h2>Login do Usuário</h2>
      <input type="text" id="cpf" placeholder="CPF" />
      <input type="password" id="senha" placeholder="Senha" />
      <button onclick="fazerLogin()">Entrar</button>
      <button onclick="window.location.href='cadastro.html'">Cadastrar</button>
    </div>

    <script>
      function fazerLogin() {
        const cpf = document.getElementById("cpf").value.trim();
        const senha = document.getElementById("senha").value.trim();

        if (!cpf || !senha) {
          alert("Preencha CPF e senha.");
          return;
        }

        const usuarios =
          JSON.parse(localStorage.getItem("usuariosCadastrados")) || [];
        const usuario = usuarios.find(
          (u) => u.cpf === cpf && u.senha === senha
        );

        if (usuario) {
          alert("Login realizado com sucessooo!");
          localStorage.setItem("usuarioLogadoCPF", cpf); // salvar CPF do usuário logado
          window.location.href = "menu.html"; // redirecionaaa para menu
        } else {
          alert("CPF ou senha incorretos.");
        }
      }
    </script>
  </body>
</html>
