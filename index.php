<?php
require_once "personagens/jogador.php"; 

session_start();

if($_SERVER['REQUEST_METHOD'] == "POST"){

    if($_POST['nome'] == 'luis') {
        $_SESSION["jogador"] = new jogador ($_POST['nome'],$_POST['genero'], 1000,50);
    }
    else {
        $_SESSION["jogador"] = new jogador ($_POST['nome'],$_POST['genero'], 100, 10);
    }
    $_SESSION["jogador"] = new jogador($_POST['nome'],$_POST['genero'], 100, 10);
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
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
         <img src='imagens/guerreiropngindex.png' id='heroi'>

        <div class="hud">
            
        <h1>Labirinto das aleatoriedades</h1>
        <h3>Crie seu personagem:</h3>

        <form method="POST">
            <input 
                type="text"name="nome" placeholder="Nome"required>
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