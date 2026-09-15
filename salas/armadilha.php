<?php 
require_once "../personagens/inimigos.php";     
require_once "../personagens/jogador.php";    
require_once "../funcoes/funcoes.php"; 

session_start(); 

$chance = rand(1, 100); 
$chance2 = rand(1, 100); 
$chanceM = max($chance, $chance2); 

$jogador = $_SESSION['jogador']; 

$derrotado = false; 
$vitoria = false; 
 
if(isset($_POST['acao']) && $_POST['acao'] == 'fugir'){     
   
    header("Location: ../labirinto.php");     
    exit;     
} 
 
elseif(isset($_POST['acao']) && $_POST['acao'] == 'desarmar'){ 

    if($chanceM > 65){ 
        $vitoria = true;
    } 
 
    elseif($chanceM > 5 && $chanceM <= 65){ 
        $jogador->recebe_dano($jogador->getvidaMax() / 2); 
        
        if($jogador->getVida() > 0){ 
            $vitoria = true; 
        }
    } 
 
    else{ 
        $jogador->recebe_dano(9999999);
    } 
} 
 
elseif(isset($_POST['acao']) && $_POST['acao'] == 'passar'){ 

    if($chance < 50){ 
        $jogador->recebe_dano(($jogador->getvidaMax() / 4) * 3); 
        
        if($jogador->getVida() > 0){ 
            $vitoria = true; 
        } 
    } 
    else{      
        $vitoria = true; 
    } 
} 
 
if($jogador->getmorto() == true){    
   
    unset($_SESSION['jogador']);    
    $derrotado = true; 
             
} 

if($vitoria){ 

    $sala = $_SESSION['SalaAtual']; 

    liberarProximasSalas($jogador, $sala); 

    $_SESSION['jogador'] = $jogador;
} 
?> 
 
<!DOCTYPE html> 
<html lang="pt-br"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" href="../css/armadilha.css">
    <?php if($derrotado){ ?>    
        <meta http-equiv="refresh" content="2;url=../index.php">    
    <?php } ?> 
    <?php if($vitoria){ ?>   
        <meta http-equiv="refresh" content="2;url=../labirinto.php">   
    <?php } ?> 
    <title>Armadilha</title> 
</head> 

<body> 

    <?php if($derrotado) { ?>    
        <div class="resultado">
            <h1>Você foi derrotado!</h1>        
            <p>Voltando para a tela inicial...</p> 
        </div>
    <?php } elseif($vitoria) { ?>    
        <div class="resultado">
            <h1>Você passou pela armadilha!</h1>    
            <p>Voltando para o labirinto...</p> 
        </div>
    <?php } else { ?>

        <div class="armadilha">

        <h1>Armadilha</h1> 
 
        <form method="post"> 
            <button type="submit" name="acao" value="fugir">
                Fugir
            </button> 

            <button type="submit" name="acao" value="desarmar">
                Tentar desarmar
            </button> 

            <button type="submit" name="acao" value="passar">
                Correr pela armadilha
            </button> 
        </form>
    </div>
    <?php } ?> 
    
</body> 
</html>