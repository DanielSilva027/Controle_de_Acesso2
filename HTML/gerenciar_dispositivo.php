<?php
include("conexao.php"); // Importa a conexão com o banco de dados
include("menu.php");

$stmt = mysqli_query($connect, "SELECT * FROM dispositivos");

if ( mysqli_num_rows($stmt) > 0 ) {
    while ($row = mysqli_fetch_assoc($stmt)) {
        echo "<tr>";
        echo "<td>" . $row['nome'] . "</td>";
        echo "<td>" . $row['localizacao'] . "</td>";
        echo "<td>" . $row['modelo'] . "</td>";
        echo "<td>" . $row['id'] . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>Nenhum dispositivo encontrado</td></tr>";
}

 mysqli_free_result($stmt);
 mysqli_close($connect);
?>