<?php

require_once "config.php";

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (!isset($_SESSION['jogador'])) {
    header("Location: index.php");
    exit;
}

if (isset($_GET['sala'])) {

    $_SESSION['SalaAtual'] = (int) $_GET['sala'];

}

if (!isset($_SESSION['SalaAtual'])) {

    header("Location: labirinto.php");
    exit;

}

$sala = $_SESSION['SalaAtual'];

$jogador = $_SESSION['jogador'];

if (!in_array($sala, $jogador->getSalas())) {

    header("Location: labirinto.php");
    exit;

}

if ($sala == 15) {

    header("Location: salas/boss.php");
    exit;

}

if ($sala == 11) {

    header("Location: salas/combate.php");
    exit;

}

if (!isset($_SESSION['desafios'])) {

    $_SESSION['desafios'] = [];

}

if (!isset($_SESSION['desafios'][$sala])) {

    $chance = rand(1, 100);

    if ($chance <= 40) {

        $_SESSION['desafios'][$sala] = 1;

    } elseif ($chance <= 75) {

        $_SESSION['desafios'][$sala] = 3;

    } else {

        $_SESSION['desafios'][$sala] = 2;

    }

}

$tipodesafio = $_SESSION['desafios'][$sala];

if ($tipodesafio == 1) {

    header("Location: salas/combate.php");

} elseif ($tipodesafio == 2) {

    header("Location: salas/armadilha.php");

} elseif ($tipodesafio == 3) {

    header("Location: salas/SalaBau.php");

}

exit;

?>