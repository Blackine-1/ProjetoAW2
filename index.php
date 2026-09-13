<?php
require_once "personagens/jogador.php"; 
session_start();

if($_SERVER['REQUEST_METHOD'] == "POST"){

    if($_POST['nome'] == 'luis') {
        $_SESSION["jogador"] = new jogador ($_POST['nome'],$_POST['genero'], 1000,70);
    }
    else {
        $_SESSION["jogador"] = new jogador ($_POST['nome'],$_POST['genero'], 100, 10);
    }
    $_SESSION['jogador']->liberarSala(11);
    header("Location: labirinto.php");
    exit();
};
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Labirinto</title>
</head>
<body>
    <div class="inicio">
        <h1>Labirinto das aleatoriedades</h1>
        <p>Crie seu personagem:</p>
        <form method="POST">
            <input 
                type="text" 
                name="nome" 
                placeholder="Nome"
                required
            >
            <br>
            <label><input type="radio" name="genero" value="masculino" required>Masculino</label>
            <label><input type="radio" name="genero" value="feminino">Feminino</label>
            <br>
            <input type="submit" value="Iniciar">
            <input type="reset" value="Limpar">
</form>

    </div>
</body>
</html>