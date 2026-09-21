<?php 
require_once "config.php"; 
if (session_status() !== PHP_SESSION_ACTIVE) {session_start();} 
 
if($_SERVER['REQUEST_METHOD'] == "POST"){ 
    
    $_SESSION = [];
    
    if($_POST['nome'] == 'luis') { 
        $_SESSION["jogador"] = new jogador ($_POST['nome'],$_POST['genero'], 1000,99999); 
        $jogador = $_SESSION["jogador"]; 
 
        $espada = new Arma("Espada de Teste", 20, "Comum"); 
        $elmo = new armadura("Elmo de Teste", "cabeca", 30, "Raro"); 
        $pocao = new consumivel("Poção de Teste", 25, "Épico"); 
 
        $jogador->colocaItem($espada); 
        $jogador->colocaItem($elmo); 
        $jogador->colocaItem($pocao); 
        $_SESSION['jogador']->liberarSala(11);  
    } 
    else { 
        $_SESSION["jogador"] = new jogador ($_POST['nome'],$_POST['genero'], 200, 10); 
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
    <link rel="stylesheet" href="css/index.css"> 
</head> 

<body> 

    <img src='imagens/guerreiropngindex.png' id='heroi'> 
 
    <div class="hud"> 
             
        <h1>Labirinto das aleatoriedades</h1> 
        <h3>Crie seu personagem:</h3> 
 
        <form method="POST"> 
            <input type="text" name="nome" placeholder="Nome" required>
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

        <br>

        <form action="ranking.php" method="GET">
            <button type="submit">Ver Ranking</button>
        </form>
 
    </div> 
 
</body> 
</html>