<?php

require_once "personagens/jogador.php";
require_once "personagens/inimigos.php";

$jogador = new jogador("Luis", "masculino", 1020, 10);
$inimigo = new inimigo("Goblin", 50, 5);

$espada = new Arma("Espada de Ferro", 20);

$capacete =new armadura("capacete","cabeca", 100);
$peitoral =new armadura("peitoral","peito", 100);
$perna =new armadura("perna","perna", 100);

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

$inimigo->atacar($jogador);
echo "Vida do jogador após ataque do inimigo: " . $jogador->getvida() . "<br>";
echo "vida maxima do jogador após ataque do inimigo: " . $jogador->getvidamax() . "<br>";
echo "vida base do jogador após ataque do inimigo: " . $jogador->getVidaBase() . "<br>";
$jogador->desequiparItem("cabeca");
echo "Vida do jogador após remover capacete: " . $jogador->getvida() . "<br>";



?>