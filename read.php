<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ler Clientes</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        
        #errorMessage {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 1000;
        }

        #overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 500;
        }
    </style>
</head>
<body>
    <div id="overlay"></div>
    <div class="menu">
        <button onclick="toggleMenu()">Menu</button>
        <div id="menu-content" class="menu-content">
            <a href="create.php">Inserir</a>
            <a href="read.php" class="disabled">Ler</a>
            <a href="update.php">Editar</a>
            <a href="delete.php">Deletar</a>
        </div>
    </div>
    <div class="container">
        <h1>Clientes</h1>
        <form id="searchForm">
            <input type="text" id="searchIdField" placeholder="Procurar por ID">
            <input type="text" id="searchCpfField" placeholder="Procurar por CPF">
            <button type="button" onclick="searchCliente()" class="crud-button">Procurar</button>
            <button type="button" onclick="exportarClientes()" class="crud-button">Exportar</button>
        </form>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Email</th>
                        <th>Banco</th>
                        <th>Dívida</th>
                        <th>Valor</th>
                        <th>Desconto</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody id="clienteTableBody">
                    <?php
                    include 'db.php';
                    $sql = "SELECT * FROM clientes";
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
                        echo "<tr><td colspan='9'>Nenhum cliente encontrado</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
        <div id="errorMessage">
            <p>Cliente não localizado!</p>
            <button onclick="hideErrorMessage()" class="button">OK</button>
            <a href="create.php" class="button">Criar Cadastro</a>
        </div>
        <div class="botoes-container">
            <a href="index.php" class="button">Voltar</a>
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

        function searchCliente() {
            var searchIdValue = document.getElementById('searchIdField').value;
            var searchCpfValue = document.getElementById('searchCpfField').value;
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'search_cliente.php?searchId=' + searchIdValue + '&searchCpf=' + searchCpfValue, true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    if (xhr.responseText.trim()) {
                        document.getElementById('clienteTableBody').innerHTML = xhr.responseText;
                    } else {
                        showErrorMessage();
                    }
                }
            };
            xhr.send();
        }

        function showErrorMessage() {
            document.getElementById('overlay').style.display = 'block';
            document.getElementById('errorMessage').style.display = 'block';
        }

        function hideErrorMessage() {
            document.getElementById('overlay').style.display = 'none';
            document.getElementById('errorMessage').style.display = 'none';
        }

        function editCliente(id) {
            window.location.href = 'update.php?id=' + id;
        }

        function exportarClientes() {
            window.location.href = 'exportar_clientes.php';
        }
    </script>
</body>
</html>
