<?php
include 'db.php';

$searchId = isset($_GET['searchId']) ? $_GET['searchId'] : '';
$searchCpf = isset($_GET['searchCpf']) ? $_GET['searchCpf'] : '';

$sql = "SELECT * FROM clientes WHERE (id LIKE '%$searchId%' AND '$searchId' != '') OR (cpf LIKE '%$searchCpf%' AND '$searchCpf' != '')";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['nome_completo']}</td>
                <td>{$row['cpf']}</td>
                <td>{$row['email']}</td>
                <td>{$row['banco']}</td>
                <td>{$row['divida']}</td>
                <td>{$row['valor_divida']}</td>
                <td>{$row['valor_desconto']}</td>
                <td><button onclick='editCliente({$row['id']})'><img src='edit_icon.png' alt='Editar' /></button></td>
              </tr>";
    }
} else {
    echo "";
}

$conn->close();
?>
