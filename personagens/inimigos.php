<?php 

require_once "../personagens/base.php"; 

class inimigo extends base {
    private string $classeVida;
    private string $classeDano;

    function __construct($nome, $VidaBase, $dano, $classeVida, $classeDano) {
        $this->nome = $nome;
        $this->VidaBase = $VidaBase;
        $this->vida_maxima = $VidaBase;
        $this->vida_atual = $VidaBase;
        $this->dano = $dano;

        $this->classeVida = $classeVida;
        $this->classeDano = $classeDano;
    }
    function getNome() {
        return $this->nome;
    }
    function getClasseVida() {
        return $this->classeVida;
    }

    function getClasseDano() {
        return $this->classeDano;
    }
}

?>