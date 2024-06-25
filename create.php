<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserir Cliente</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="menu">
        <button onclick="toggleMenu()">Menu</button>
        <div id="menu-content" class="menu-content">
            <a href="create.php" class="disabled">Inserir</a>
            <a href="read.php">Ler</a>
            <a href="update.php">Editar</a>
            <a href="delete.php">Deletar</a>
        </div>
    </div>
    <div class="container">
        <h1>Inserir Cliente</h1>
        <form method="POST" action="create.php" id="createForm">
            <input type="number" id="id" name="id" placeholder="ID do Cliente" required>
            <input type="text" id="nome_completo" name="nome_completo" placeholder="Nome Completo" required>
            <input type="text" id="cpf" name="cpf" placeholder="CPF" required>
            <input type="email" id="email" name="email" placeholder="E-mail" required>
            <select id="banco" name="banco" required>
                <option selected disabled value="">Banco</option>
                <option>Bradesco</option>
                <option>Itaú</option>
                <option>Santander</option>
                <option>Sicred</option>
                <option>C6</option>
                <option>Inter</option>
            </select>
            <select id="divida" name="divida" required>
                <option selected disabled value="">Produto Dívida</option>
                <option>Empréstimo</option>
                <option>Cartão</option>
                <option>Cheque Especial</option>
                <option>Veículo</option>
                <option>Imóvel</option>
                <option>Consignado</option>
            </select>
            <input type="number" step="0.01" id="valor_divida" name="valor_divida" placeholder="Valor da Dívida" required>
            <input type="number" step="0.01" id="valor_desconto" name="valor_desconto" placeholder="Valor com Desconto" required>
            <div class="botoes-container">
                <button class="button" type="submit">Inserir</button>
                <a href="index.php" class="button">Voltar</a>
            </div>
        </form>
        <div id="successMessage" style="display: none;">
            <p>Cliente inserido com sucesso!</p>
            <button onclick="hideSuccessMessage()" class="button">OK</button>
        </div>
        <div id="errorMessage" style="display: none;">
            <p>ID já cadastrado!</p>
            <button onclick="hideErrorMessage()" class="button">OK</button>
        </div>
    </div>
    <script>
        function toggleMenu() {
            var menuContent = document.getElementById('menu-content');
            if (menuContent.style.display === 'block') {
                menuContent.style.display = 'none';
            } else {
                menuContent.style.display = 'block';
            }
        }

        function showSuccessMessage() {
            document.getElementById('createForm').style.display = 'none';
            document.getElementById('successMessage').style.display = 'block';
        }

        function hideSuccessMessage() {
            document.getElementById('createForm').style.display = 'block';
            document.getElementById('successMessage').style.display = 'none';
        }

        function showErrorMessage() {
            document.getElementById('createForm').style.display = 'none';
            document.getElementById('errorMessage').style.display = 'block';
        }

        function hideErrorMessage() {
            document.getElementById('createForm').style.display = 'block';
            document.getElementById('errorMessage').style.display = 'none';
        }
    </script>
</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'db.php';
    $id = $_POST['id'];
    $nome_completo = $_POST['nome_completo'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $banco = $_POST['banco'];
    $divida = $_POST['divida'];
    $valor_divida = $_POST['valor_divida'];
    $valor_desconto = $_POST['valor_desconto'];

    $checkId = "SELECT * FROM clientes WHERE id='$id'";
    $result = $conn->query($checkId);

    if ($result->num_rows > 0) {
        echo "<script>showErrorMessage();</script>";
    } else {
        $sql = "INSERT INTO clientes (id, nome_completo, cpf, email, banco, divida, valor_divida, valor_desconto) VALUES ('$id', '$nome_completo', '$cpf', '$email', '$banco', '$divida', '$valor_divida', '$valor_desconto')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>showSuccessMessage();</script>";
        } else {
            echo "Erro: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
}
?>