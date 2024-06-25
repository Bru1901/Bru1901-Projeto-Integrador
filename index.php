<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Clientes</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(to right, #00c6ff, #0072ff);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }
        h1 {
            margin-bottom: 20px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: #0056b3;
        }
        .menu {
            position: absolute;
            top: 20px;
            left: 20px;
        }
        .menu button {
            background: #007bff;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .menu button:hover {
            background: #0056b3;
        }
        .menu-content {
            display: none;
            position: absolute;
            top: 50px;
            left: 20px;
            background: white;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 10px;
            text-align: left;
        }
        .menu-content a {
            display: block;
            padding: 10px;
            color: #007bff;
            text-decoration: none;
            transition: background 0.3s;
        }
        .menu-content a:hover {
            background: #f4f4f4;
        }
    </style>
</head>
<body>
    <div class="menu">
        <button onclick="toggleMenu()">Menu</button>
        <div id="menu-content" class="menu-content">
            <a href="create.php">Inserir</a>
            <a href="read.php">Ler</a>
            <a href="update.php">Editar</a>
            <a href="delete.php">Deletar</a>
        </div>
    </div>
    <div class="container">
        <h1>CRUD de Clientes</h1>
        <div class="botoes-container">
            <a href="create.php" class="crud-button">Inserir</a>
            <a href="read.php" class="crud-button">Ler</a>
            <a href="update.php" class="crud-button">Editar</a>
            <a href="delete.php" class="crud-button">Deletar</a>
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
    </script>
</body>
</html>
