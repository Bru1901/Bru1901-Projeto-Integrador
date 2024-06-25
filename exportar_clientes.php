<?php
include 'db.php';

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=clientes.csv');

$output = fopen('php://output', 'w');
fputcsv($output, array('ID', 'Nome', 'CPF', 'Email', 'Banco', 'Dívida', 'Valor', 'Desconto'));

$sql = "SELECT id, nome_completo, cpf, email, banco, divida, valor_divida, valor_desconto FROM clientes";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        fputcsv($output, $row);
    }
}

fclose($output);
$conn->close();
?>
