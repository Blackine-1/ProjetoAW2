<?php
require_once "base.php";
class jogador extends base {
    protected string $genero;
    function __construct($nome,$genero, $vida_maxima,$dano){
    $this->nome = $nome;
    $this->vida_maxima = $vida_maxima;
    $this->dano = $dano;
    $this->vida_atual = $vida_maxima;
    $this->genero = $genero;
}
    function getnome(){
        return $this->nome;
    }
    

}
?>