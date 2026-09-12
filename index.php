<?php
require_once "personagens/jogador.php"; 

session_start();

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $_SESSION["jogador"] = new jogador($_POST['nome'], $_POST['genero'], 100, 10);
    header("Location: labirinto.php");
    exit();
};
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Random maze</title>

    <style>
        body {
    margin: 0;
    background-color: black;
    color: white;
    text-align: center;
}
        

        .inicio {
            margin: 100px auto;
            width: 400px;
            background-color: grey;
            padding: 30px;
            border-radius: 10px
         }

        h1 {
            color: Yellow;
        }

        input[type="text"] {
            width: 250px;
        }

        input[type="submit"], input[type="reset"] {
            padding: 8px 15px;
            margin: 10px 5px;
        }
    </style>
</head>
<body>
    <div class="inicio">
        <h1>Labirinto</h1>

        <p>Crie seu personagem:</p>

        <form method="POST">
            <input 
                type="text" 
                name="nome" 
                placeholder="Nome"
                required
            >
            <br>
            <label>
                <input type="radio" name="genero" value="masculino" required>
                Masculino
            </label>

            <label>
                <input type="radio" name="genero" value="feminino">
                Feminino
            </label>

            <br>

            <input type="submit" value="Iniciar">
            <input type="reset" value="Limpar">
        </form>

    </div>
</body>
</html>