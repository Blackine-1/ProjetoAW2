<?php
require_once "personagens/jogador.php"; 

session_start();
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $_SESSION["jogador"] = new jogador ($_POST['nome'],$_POST['genero'], 100, 10);
    header("Location: labirinto.php");
    exit();
};

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST">
        <input type="text" name="nome" placeholder="Insira seu nome"><br>
        <label><input type="radio" name="genero" value="masculino">masculino</label>
        <label><input type="radio" name="genero" value="feminino">feminino</label><br>
        <input type="submit">
        <input type="reset">
    </form><br>

    <a href="teste.php">teste</a>
</body>
</html>