<?php

require_once "personagens/base.php";
require_once "itens.php";

class jogador extends base {

    protected string $genero;

    protected int $dano_base;

    protected array $SalasLiberadas = [];

    protected array $inventario = [];

    protected array $equipamentos = [
        "cabeça" => null,
        "peitoral" => null,
        "pernas" => null,
        "mao" => null
    ];


    function __construct($nome, $genero, $vida_maxima, $dano) {

        $this->nome = $nome;
        $this->vida_maxima = $vida_maxima;
        $this->vida_atual = $vida_maxima;

        $this->dano = $dano;
        $this->dano_base = $dano;

        $this->genero = $genero;
    }


    function getNome() {

        return $this->nome;
    }


    function getGenero() {

        return $this->genero;
    }


    function getSalas() {

        return $this->SalasLiberadas;
    }


    function getInventario() {

        return $this->inventario;
    }


    function getEquipamentos() {

        return $this->equipamentos;
    }


    function colocaItem($item) {

        $this->inventario[] = $item;
    }


    function equiparItem($item) {

        $slot = $item->getSlot();

        if (array_key_exists($slot, $this->equipamentos)) {

            $this->equipamentos[$slot] = $item;

            if ($item instanceof Arma) {

                $this->dano = $this->dano_base + $item->getDano();
            }
        }
    }


    function desequiparItem($slot) {

        if (array_key_exists($slot, $this->equipamentos)) {

            $this->equipamentos[$slot] = null;

            if ($slot == "mao") {

                $this->dano = $this->dano_base;
            }
        }
    }

}

?>