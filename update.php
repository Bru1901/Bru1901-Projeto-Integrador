<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body onload="checkIfEditPage()">
    <div class="menu">
        <button onclick="toggleMenu()">Menu</button>
        <div id="menu-content" class="menu-content">
            <a href="create.php">Inserir</a>
            <a href="read.php">Ler</a>
            <a href="update.php" class="disabled">Editar</a>
            <a href="delete.php">Deletar</a>
        </div>
    </div>
    <div class="container">
        <h1>Editar Cliente</h1>
        <form method="POST" action="update.php" id="updateForm">
            <input type="number" id="id" name="id" placeholder="ID do Cliente" required onblur="loadCliente()" onkeydown="checkEnter(event)">
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
                <button class="button" type="submit">Editar</button>
                <a href="index.php" class="button">Voltar</a>
            </div>
        </form>
        <div id="successMessage" style="display: none;">
            <p>Cliente editado com sucesso!</p>
            <button onclick="hideSuccessMessage()" class="button">OK</button>
        </div>
        <div id="notFoundMessage" style="display: none;">
            <p>Cadastro não localizado!</p>
            <button onclick="hideNotFoundMessage()" class="button">OK</button>
            <a href="create.php" class="button">Criar Cadastro</a>
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

        function checkEnter(event) {
            if (event.key === "Enter") {
                event.preventDefault();
                loadCliente();
            }
        }

        function loadCliente() {
            var id = document.getElementById('id').value;
            if (id) {
                var xhr = new XMLHttpRequest();
                xhr.open('GET', 'load_cliente.php?id=' + id, true);
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        var cliente = JSON.parse(xhr.responseText);
                        if (cliente) {
                            document.getElementById('id').readOnly = true;
                            document.getElementById('nome_completo').value = cliente.nome_completo;
                            document.getElementById('cpf').value = cliente.cpf;
                            document.getElementById('email').value = cliente.email;
                            document.getElementById('banco').value = cliente.banco;
                            document.getElementById('divida').value = cliente.divida;
                            document.getElementById('valor_divida').value = cliente.valor_divida;
                            document.getElementById('valor_desconto').value = cliente.valor_desconto;
                        } else {
                            showNotFoundMessage();
                        }
                    }
                };
                xhr.send();
            }
        }

        function checkIfEditPage() {
            const urlParams = new URLSearchParams(window.location.search);
            const id = urlParams.get('id');
            if (id) {
                document.getElementById('id').value = id;
                loadCliente();
            }
        }

        function showSuccessMessage() {
            document.getElementById('updateForm').style.display = 'none';
            document.getElementById('successMessage').style.display = 'block';
        }

        function hideSuccessMessage() {
            document.getElementById('updateForm').style.display = 'block';
            document.getElementById('successMessage').style.display = 'none';
        }

        function showNotFoundMessage() {
            document.getElementById('updateForm').style.display = 'none';
            document.getElementById('notFoundMessage').style.display = 'block';
        }

        function hideNotFoundMessage() {
            document.getElementById('updateForm').style.display = 'block';
            document.getElementById('notFoundMessage').style.display = 'none';
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

    $sql = "UPDATE clientes SET nome_completo='$nome_completo', cpf='$cpf', email='$email', banco='$banco', divida='$divida', valor_divida='$valor_divida', valor_desconto='$valor_desconto' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>showSuccessMessage();</script>";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
