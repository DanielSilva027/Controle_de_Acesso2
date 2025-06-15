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
      <form action="push_dispositivo.php" method="POST">
        <input type="text" id="nome" name="nome" placeholder="Nome do dispositivo" required /><br>
        <input type="number" id="numero_serie" name="numero_serie" placeholder="Número de série do dispositivo" required /><br>
        <input type="text" id="localizacao" name="localizacao" placeholder="Localização do dispositivo" required /><br>
        <button type="submit" name="btn-cadastrar_disp">Cadastrar</button>
        <button type="button" onclick="window.location.href='menu.php'">Voltar</button>
      </form>
    </div>
  </body>
</html>
