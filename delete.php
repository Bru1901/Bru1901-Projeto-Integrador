<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deletar Cliente</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        
        #successMessage, #errorMessage {
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

        .botoes-container {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div id="overlay"></div>
    <div class="menu">
        <button onclick="toggleMenu()">Menu</button>
        <div id="menu-content" class="menu-content">
            <a href="create.php">Inserir</a>
            <a href="read.php">Ler</a>
            <a href="update.php">Editar</a>
            <a href="delete.php" class="disabled">Deletar</a>
        </div>
    </div>
    <div class="container">
        <h1>Deletar Cliente</h1>
        <form id="deleteForm">
            <input type="text" id="deleteIdField" placeholder="ID do Cliente">
            <input type="text" id="deleteCpfField" placeholder="CPF do Cliente">
            <div class="botoes-container">
                <button type="button" onclick="deleteCliente()" class="button">Deletar</button>
                <a href="index.php" class="button">Voltar</a>
            </div>
        </form>
        <div id="successMessage">
            <p>Cliente deletado com sucesso!</p>
            <button onclick="hideSuccessMessage()" class="button">OK</button>
        </div>
        <div id="errorMessage">
            <p>Cadastro não localizado!</p>
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

        function deleteCliente() {
            var deleteIdValue = document.getElementById('deleteIdField').value;
            var deleteCpfValue = document.getElementById('deleteCpfField').value;
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'delete_cliente.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    if (xhr.responseText.trim() === 'success') {
                        showSuccessMessage();
                    } else {
                        showErrorMessage();
                    }
                }
            };
            xhr.send('deleteId=' + deleteIdValue + '&deleteCpf=' + deleteCpfValue);
        }

        function showSuccessMessage() {
            document.getElementById('overlay').style.display = 'block';
            document.getElementById('successMessage').style.display = 'block';
        }

        function hideSuccessMessage() {
            document.getElementById('overlay').style.display = 'none';
            document.getElementById('successMessage').style.display = 'none';
            document.getElementById('deleteIdField').value = '';
            document.getElementById('deleteCpfField').value = '';
        }

        function showErrorMessage() {
            document.getElementById('overlay').style.display = 'block';
            document.getElementById('errorMessage').style.display = 'block';
        }

        function hideErrorMessage() {
            document.getElementById('overlay').style.display = 'none';
            document.getElementById('errorMessage').style.display = 'none';
        }
    </script>
</body>
</html>
