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
      <form action="processa_cadastro.php" method="POST" enctype="multipart/form-data">
        <input type="text" id="cpf" name="cpf" placeholder="CPF (chave primária)" required /><br>
        <input type="text" id="nome" name="nome" placeholder="Nome completo" required /><br>
        <input type="email" id="email" name="email" placeholder="E-mail" required /><br>
        <input type="text" id="telefone" name="telefone" placeholder="Telefone" required /><br>
        <select id="tpc" name="tpc" required><br>
          <option value="">Selecione o tipo de conta</option>
          <option value="Admin">Admin</option>
          <option value="Usuario">Usuário</option>
        </select>

        <label for="face">Foto (Face ID):</label>
        <input type="file" id="face" name="face" accept="image/*" required />

        <input type="password" id="senha" name="senha" placeholder="Senha de Acesso" required />
        <button type="submit">Cadastrar</button>  <br> <br>
      
        <button type="button" onclick="window.location.href='index.php'">Voltar</button>
      </form>
    </div>
  </body>
</html>