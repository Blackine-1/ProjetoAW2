<?php
require_once "config.php";
if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
$salas = [7,8,9,10,11,12,15,17,18,19,20];

$jogador = $_SESSION['jogador'];
$jogador->liberarSala(11);
$inventarioaberto = false;

    if(isset($_POST['acao']) && $_POST['acao'] ==  'fecharinventario'){
        $inventarioaberto = false;
    }
    if(isset($_POST['acao']) && $_POST['acao'] ==  'inventario'){
        $inventarioaberto = true;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/labirinto.css">
    <link rel="stylesheet" href="css/inventario.css">
</head>
<body>
    <?php if($inventarioaberto == false){ ?>
    <div class="labirinto">
        
        <?php 
            for($i = 1; $i <= 25; $i++){

                if(in_array($i, $salas)){

                    echo "<a href='dados.php?sala=$i'>";
                    echo "<div></div>";
                    echo "</a>";

                } else {

                    echo "<div class='esconder'></div>";

                }

            }
            ?>
            <form method="POST">
            <button type="submit" name="acao" value="inventario">  
                        Inventário  
            </button>
        </form>
       <?php } ?>
        <?php
        if($inventarioaberto == true){
            inventario($jogador);
        }
        ?>

    </div>


    
</body>
</html>