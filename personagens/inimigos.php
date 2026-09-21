<?php

class inimigo extends base {

    private string $classeVida;
    private string $classeDano;
    private string $imagem;


    function __construct($nome, $VidaBase, $dano, $classeVida, $classeDano, $imagem) {

        $this->nome = $nome;

        $this->VidaBase = $VidaBase;
        $this->vida_maxima = $VidaBase;
        $this->vida_atual = $VidaBase;

        $this->dano = $dano;

        $this->classeVida = $classeVida;
        $this->classeDano = $classeDano;

        $this->imagem = $imagem;
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


    function getImagem() {

        return $this->imagem;
    }
}

?>