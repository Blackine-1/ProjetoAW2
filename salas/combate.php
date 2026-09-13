
<?php    
require_once "../personagens/inimigos.php";    
require_once "../personagens/jogador.php";    
require_once "../personagens/gerainimigo.php";    
require_once "../funcoes/funcoes.php";
  
session_start();    
  
$jogador = $_SESSION['jogador'];    
$vitoria = false;  
$derrotado = false;



if(!isset($_SESSION['turno'])){  
    $_SESSION['turno'] = "jogador"; 
}  
  
  
  
if(!isset($_SESSION['inimigo'])){    
    $gerador = new gerador();    
    $_SESSION['inimigo'] = $gerador->gerar();    
}    
  
$inimigo = $_SESSION['inimigo'];   
  
  
if($_SESSION['turno'] == "jogador"){  
  
    if(isset($_POST['acao']) && $_POST['acao'] == 'atacar'){    
  
        $jogador->atacar($inimigo);    
  
        if($inimigo->getmorto() == true){   
  
            unset($_SESSION['inimigo']);   
            $vitoria = true;  

            $sala = $_SESSION['SalaAtual'];
            liberarProximasSalas($jogador, $sala);
            $_SESSION['jogador'] = $jogador;

        } else {  
  
            $_SESSION['turno'] = "inimigo";  
  
            $_SESSION['jogador'] = $jogador;  
            $_SESSION['inimigo'] = $inimigo;  
  
            header("Location: combate.php");    
            exit;  
        } 
    }  
  
    if(isset($_POST['acao']) && $_POST['acao'] == 'fugir'){    
  
        unset($_SESSION['inimigo']);    
        header("Location: ../labirinto.php");    
        exit;    
    }     
}  
  
if($_SESSION['turno'] == "inimigo"){  
  
    if(isset($_POST['acao']) && $_POST['acao'] == 'turno_inimigo'){  
  
        $inimigo->atacar($jogador);  
        if($jogador->getmorto() == true){   
  
            unset($_SESSION['jogador']);   
            $derrotado = true;
            
            unset($_SESSION['inimigo']);
            unset($_SESSION['turno']);
            
        } 
        else {
        $_SESSION['jogador'] = $jogador;  
        $_SESSION['inimigo'] = $inimigo;  
        $_SESSION['turno'] = "jogador";  
  
        header("Location: combate.php");    
        exit;  
        }
    }
} 
  
  
  
  
?>    
  
  
<!DOCTYPE html>   
<html lang="en">   
  
<head>   
    <meta charset="UTF-8">   
    <meta name="viewport" content="width=device-width, initial-scale=1.0">   
  
    <link rel="stylesheet" href="../css/combate.css">   
    <script src="../js/combate.js"></script> 

    <title>Combate</title>   
  
    <?php if($vitoria){ ?>   
        <meta http-equiv="refresh" content="2;url=../labirinto.php">   
    <?php } ?>   
    <?php if($derrotado){ ?>   
        <meta http-equiv="refresh" content="2;url=../index.php">   
    <?php } ?> 
  
</head>   
  
  
<body>   
  
    <main class="combate">   
  
  
        <?php if($vitoria){ ?>   
  
            <h1>Você venceu!</h1>   
            <p>Voltando para o labirinto...</p>   
  
        <?php } elseif($derrotado) { ?>   
  
            <h1>Você foi derrotado!</h1>   
            <p>Voltando para a tela inicial...</p>

        <?php } else { ?>   
  
  
            <p id="mensagem"></p> 

            <section class="personagens">   
                 
  
                <div class="jogador">   
  
                    <img src="../imagens/token_salatiel.png" alt="Jogador">   
  
                    <p>   
                        Vida:   
                        <?php echo $jogador->getvida(); ?>   
                        /   
                        <?php echo $jogador->getvidamax(); ?>   
                    </p>   
  
                </div>   
  
  
                <div class="inimigo">   
  
                    <img src="../imagens/valegor_saharen.png" alt="Inimigo">   
  
                    <p>   
  
                        <?php   
                        echo $inimigo->getNome() . ' ' .   
                             $inimigo->getClasseDano() . ' ' .   
                             $inimigo->getClasseVida() . "<br>";   
                        ?>    
  
                        Vida:   
                        <?php echo $inimigo->getvida(); ?>   
                        /   
                        <?php echo $inimigo->getvidamax(); ?>   
  
                    </p>   
  
                </div>   
  
  
            </section>   
  
  
            <section class="acoes">   
  
                <form method="POST">   
  
                    <button type="button" name="acao" value="atacar" onclick="atacar(this.form)"> 
                        Atacar 
                    </button> 
  
                    <button name="acao" value="inventario">  
                        Inventário  
                    </button>   
  
                    <button name="acao" value="fugir">  
                        Fugir  
                    </button>   
  
                </form>   
  
            </section>   
  
  
        <?php } ?>   
  
  
    </main>   

    <?php if(isset($_SESSION['turno']) && $_SESSION['turno'] == "inimigo" && !$vitoria && !$derrotado){ ?> 
        <script> 
            turnoInimigo(); 
        </script> 
    <?php } ?> 
  
</body>   
</html>

