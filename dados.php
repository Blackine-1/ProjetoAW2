<?php
session_start();
$_SESSION['tipodesafio'] = rand(1,3);

if ($_SESSION['tipodesafio'] == 1){
    header("Location: salas/combate.php");
    exit;
}
if ($_SESSION['tipodesafio'] == 2){
    header("Location: salas/armadilha.php");
    exit;
}
else {
    header("location: salas/SalaBau.php");
}
?>