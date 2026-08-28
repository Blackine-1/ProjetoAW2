<?php
require_once "personagens/base.php";

class inimigo extends base {

    function __construct($nome, $vida_maxima,$dano,){
    $this->nome = $nome;
    $this->vida_maxima = $vida_maxima;
    $this->dano = $dano;
    $this->vida_atual = $vida_maxima;
}

}

?>