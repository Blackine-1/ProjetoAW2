<?php

require_once "personagens/jogador.php";

$jogador = new jogador("Luis", "masculino", 100, 10);

$espada = new Arma("Espada de Ferro", 20);

echo "Dano inicial: " . $jogador->getDano() . "<br>";

$jogador->colocaItem($espada);

$jogador->equiparItem($espada);

echo "Dano com espada: " . $jogador->getDano() . "<br>";

$jogador->desequiparItem("mao");

echo "Dano sem espada: " . $jogador->getDano() . "<br>";

?>