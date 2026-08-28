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

    function getSlot() {
        return $this->slot;
    }
}


class Cabeca extends Item {

    protected int $defesa;
    protected string $slot = "cabeça";

    function __construct($nome, $defesa) {
        parent::__construct($nome, "cabeça");
        $this->defesa = $defesa;
    }

    function getDefesa() {
        return $this->defesa;
    }

    function getSlot() {
        return $this->slot;
    }
}


class Peitoral extends Item {

    protected int $defesa;
    protected string $slot = "peitoral";

    function __construct($nome, $defesa) {
        parent::__construct($nome, "peitoral");
        $this->defesa = $defesa;
    }

    function getDefesa() {
        return $this->defesa;
    }

    function getSlot() {
        return $this->slot;
    }
}


class Pernas extends Item {

    protected int $defesa;
    protected string $slot = "pernas";

    function __construct($nome, $defesa) {
        parent::__construct($nome, "pernas");
        $this->defesa = $defesa;
    }

    function getDefesa() {
        return $this->defesa;
    }

    function getSlot() {
        return $this->slot;
    }
}

?>