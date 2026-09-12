<?php
require_once 'personagens/jogador.php';
session_start();
$salas = [7,8,9,10,11,12,15,17,18,19,20];

$jogador = $_SESSION['jogador'];
$jogador->liberarSala(11);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/labirinto.css">
</head>
<body>
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
    </div>
</body>
</html>