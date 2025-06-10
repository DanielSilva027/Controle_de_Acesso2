<?php
// edita.php - Este arquivo lidará com a edição do usuário e do dispositivo

// Você pode incluir um cabeçalho ou lógica PHP comum aqui, se necessário
// Para localStorage, a parte do PHP está servindo principalmente a estrutura HTML.

// É crucial que 'type' e 'index' na URL correspondam EXATAMENTE aos nomes das chaves no array $_GET
$edit_type = isset($_GET['type']) ? $_GET['type'] : '';
$edit_index = isset($_GET['index']) ? (int)$_GET['index'] : -1;

// Corrigindo a verificação de tipo e índice para usar as variáveis corretas ($edit_type, $edit_index)
if (!in_array($edit_type, ['user', 'device']) || $edit_index === -1) {
    // Lidar com acesso inválido ou parâmetros ausentes
    header('Location: menu.php'); // Redirecionar de volta ao menu se for inválido
    exit();
}

// Defina o título e o título da página com base no tipo
$page_title = '';
$heading = '';
// As condições devem usar 'user' e 'device' exatamente como vêm da URL
if ($edit_type === 'user') {
    $page_title = 'Editar Usuário';
    $heading = 'Editar Usuário';
} elseif ($edit_type === 'device') {
    $page_title = 'Editar Dispositivo';
    $heading = 'Editar Dispositivo';
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($page_title); ?></title>
    <link rel="stylesheet" href="../accets/CSS/cadastro.css">
    <link rel="stylesheet" href="../accets/CSS/menu.css">
</head>
<body>
    <div class="cadastro-form-container container">
        <h1><?php echo htmlspecialchars($heading); ?></h1>
        <form id="edit-form">
            <input type="hidden" id="edit-type" value="<?php echo htmlspecialchars($edit_type); ?>">
            <input type="hidden" id="edit-index" value="<?php echo htmlspecialchars($edit_index); ?>">

            <?php if ($edit_type === 'user'): ?>
                <label for="edit-nome">Nome:</label>
                <input type="text" id="edit-nome" required>

                <label for="edit-telefone">Telefone:</label>
                <input type="tel" id="edit-telefone" required>

                <label for="edit-email">Email:</label>
                <input type="email" id="edit-email" required>

                <label for="edit-cpf">CPF:</label>
                <input type="text" id="edit-cpf" required readonly> <label for="edit-tpc">Tipo de Conta:</label>
                <input type="text" id="edit-tpc">

                <label for="edit-face">Face ID:</label>
                <input type="text" id="edit-face">
            <?php elseif ($edit_type === 'device'): ?>
                <label for="edit-nome">Nome do Dispositivo:</label>
                <input type="text" id="edit-nome" required>

                <label for="edit-localizacao">Localização:</label>
                <input type="text" id="edit-localizacao" required>

                <label for="edit-modelo">Modelo:</label>
                <input type="text" id="edit-modelo" required>
            <?php endif; ?>

            <button type="submit">Salvar Alterações</button>
            <button type="button" onclick="window.location.href='menu.php'">Cancelar</button>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const editType = document.getElementById("edit-type").value;
            const editIndex = parseInt(document.getElementById("edit-index").value);

            let dataArray;
            let currentItem;

            if (editType === 'user') {
                // Certifique-se de que a chave do localStorage está correta: "usuariosCadastrados"
                dataArray = JSON.parse(localStorage.getItem("usuariosCadastrados")) || [];
                currentItem = dataArray[editIndex];
            } else if (editType === 'device') {
                // Certifique-se de que a chave do localStorage está correta: "dispositivosCadastrados"
                dataArray = JSON.parse(localStorage.getItem("dispositivosCadastrados")) || [];
                currentItem = dataArray[editIndex];
            }

            if (!currentItem) {
                alert(`Erro: ${editType === 'user' ? 'Usuário' : 'Dispositivo'} não encontrado.`);
                window.location.href = 'menu.php';
                return;
            }

            // Preencher campos de formulário com base no tipo
            if (editType === 'user') {
                // IDs dos elementos HTML e chaves do objeto no localStorage devem ser consistentes
                document.getElementById("edit-nome").value = currentItem.nome || '';
                document.getElementById("edit-telefone").value = currentItem.telefone || '';
                document.getElementById("edit-email").value = currentItem.email || '';
                document.getElementById("edit-cpf").value = currentItem.cpf || '';
                document.getElementById("edit-tpc").value = currentItem.tpc || '';
                document.getElementById("edit-face").value = currentItem.face || '';
            } else if (editType === 'device') {
                // IDs dos elementos HTML e chaves do objeto no localStorage devem ser consistentes
                document.getElementById("edit-nome").value = currentItem.nome || '';
                document.getElementById("edit-localizacao").value = currentItem.localizacao || '';
                document.getElementById("edit-modelo").value = currentItem.modelo || '';
            }

            document.getElementById("edit-form").addEventListener("submit", function(e) {
                e.preventDefault();

                let updatedItem;
                if (editType === 'user') {
                    updatedItem = {
                        nome: document.getElementById("edit-nome").value,
                        telefone: document.getElementById("edit-telefone").value,
                        email: document.getElementById("edit-email").value,
                        cpf: document.getElementById("edit-cpf").value, // O CPF permanece do original
                        tpc: document.getElementById("edit-tpc").value,
                        face: document.getElementById("edit-face").value,
                    };
                    dataArray[editIndex] = updatedItem;
                    localStorage.setItem("usuariosCadastrados", JSON.stringify(dataArray));
                    alert("Usuário atualizado com sucesso!");
                } else if (editType === 'device') {
                    updatedItem = {
                        nome: document.getElementById("edit-nome").value,
                        localizacao: document.getElementById("edit-localizacao").value,
                        modelo: document.getElementById("edit-modelo").value,
                    };
                    dataArray[editIndex] = updatedItem;
                    localStorage.setItem("dispositivosCadastrados", JSON.stringify(dataArray));
                    alert("Dispositivo atualizado com sucesso!");
                }

                window.location.href = 'menu.php'; // Redirecionar de volta para o menu principal
            });
        });
    </script>
</body>
</html>