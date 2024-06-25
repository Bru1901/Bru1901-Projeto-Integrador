<?php
include 'db.php';

$deleteId = isset($_POST['deleteId']) ? $_POST['deleteId'] : '';
$deleteCpf = isset($_POST['deleteCpf']) ? $_POST['deleteCpf'] : '';

if ($deleteId || $deleteCpf) {
    $sql = "DELETE FROM clientes WHERE (id = '$deleteId' AND '$deleteId' != '') OR (cpf = '$deleteCpf' AND '$deleteCpf' != '')";
    if ($conn->query($sql) === TRUE && $conn->affected_rows > 0) {
        echo 'success';
    } else {
        echo 'error';
    }
} else {
    echo 'error';
}

$conn->close();
?>
