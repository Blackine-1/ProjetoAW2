<?php 

require_once "personagens/base.php"; 

class inimigo extends base { 

    function __construct($nome, $VidaBase, $dano) { 

        $this->nome = $nome; 

        $this->VidaBase = $VidaBase; 
        $this->vida_maxima = $VidaBase; 
        $this->vida_atual = $VidaBase; 

        $this->dano = $dano; 
    } 

} 

?>