<?php

require_once "personagens/jogador.php";

$jogador = new jogador("Luis", "masculino", 100, 10);

$espada = new Arma("Espada de Ferro", 20);

$capacete =new Cabeca("capacete", 100);
$peitoral =new Peitoral("peitoral", 100);
$perna =new Pernas("perna", 100);

echo "Dano inicial: " . $jogador->getDano() . "<br>";

$jogador->colocaItem($espada);

$jogador->equiparItem($espada);

echo "Dano com espada: " . $jogador->getDano() . "<br>";

$jogador->desequiparItem("mao");

echo "Dano sem espada: " . $jogador->getDano() . "<br>";

echo "Vida maxima: ". $jogador->getvida(). "<br>";
$jogador->colocaItem($capacete);
$jogador->equiparItem($capacete);
echo "vida com capacete: ". $jogador->getvida(). "<br>";
$jogador->colocaItem($peitoral);
$jogador->equiparItem($peitoral);
echo "vida com capacete e peitoral: ". $jogador->getvida(). "<br>";
$jogador->colocaItem($perna);
$jogador->equiparItem($perna);
echo "vida com capacete e peitoral e perna: ". $jogador->getvida(). "<br>";




?>