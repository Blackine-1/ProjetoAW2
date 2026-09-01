<?php

class Item {

    protected string $nome;
    protected string $tipo;

    function __construct($nome, $tipo) {
        $this->nome = $nome;
        $this->tipo = $tipo;
    }

    function getNome() {
        return $this->nome;
    }

    function getTipo() {
        return $this->tipo;
    }

        function getSlot() {
        return $this->slot;
    }
}


class Arma extends Item {

    protected int $dano;
    protected string $slot = "mao";

    function __construct($nome, $dano) {
        parent::__construct($nome, "arma");
        $this->dano = $dano;
    }

    function getDano() {
        return $this->dano;
    }

}


class Cabeca extends Item {

    protected int $VidaExtra;
    protected string $slot = "cabeça";

    function __construct($nome, $VidaExtra) {
        parent::__construct($nome, "cabeça");
        $this->VidaExtra = $VidaExtra;
    }

    function getVidaExtra() {
        return $this->VidaExtra;
    }

}


class Peitoral extends Item {

    protected int $VidaExtra;
    protected string $slot = "peitoral";

    function __construct($nome, $VidaExtra) {
        parent::__construct($nome, "peitoral");
        $this->VidaExtra = $VidaExtra;
    }

    function getVidaExtra() {
        return $this->VidaExtra;
    }

}


class Pernas extends Item {

    protected int $VidaExtra;
    protected string $slot = "pernas";

    function __construct($nome, $VidaExtra) {
        parent::__construct($nome, "pernas");
        $this->VidaExtra = $VidaExtra;
    }

    function getVidaExtra() {
        return $this->VidaExtra;
    }

}

?>