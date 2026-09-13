<?php
require_once 'personagens/jogador.php';
require_once "funcoes/funcoes.php";
session_start();

$jogador = $_SESSION['jogador'];

$_SESSION['SalaAtual'] = $_GET['sala'];

$sala = $_GET['sala'];


if (!in_array($sala, $jogador->getSalas())) {
    header("Location: labirinto.php");
    exit;
}

$_SESSION['tipodesafio'] = rand(1, 3);

if ($_SESSION['tipodesafio'] == 1) {

    header("Location: salas/combate.php");
    exit;

}
elseif ($_SESSION['tipodesafio'] == 2) {

    header("Location: salas/armadilha.php");
    exit;

}
else {

    header("Location: salas/SalaBau.php");
    exit;

}

?>