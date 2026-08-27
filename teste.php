<?php
require_once "base.php";
require_once "jogador.php";
require_once "inimigos.php";
session_start();

$p2 = new inimigo("Feh de nanda", 100, 10);
$rodada = 0;
while (!$_SESSION["jogador"]->getmorto()  && !$p2->getmorto() ){
    $_SESSION["jogador"]->atacar($p2);
    $p2->atacar($_SESSION["jogador"]);
    
    $rodada += 1;
    echo "rodada : " . $rodada."<br>";
    echo "vida do jogador : ".$_SESSION["jogador"]->getnome()." ".$_SESSION["jogador"]->getvida()."<br>";
    echo "vida inimigo 2: ".$p2->getvida()."<br>";
}
?>