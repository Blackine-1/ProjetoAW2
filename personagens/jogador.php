<?php

class jogador extends base
{

    protected string $genero;

    protected int $dano_base;
    protected int $dano_causado = 0;

    protected array $SalasVisitadas = [];
    protected array $SalasLiberadas = [];

    protected array $inventario = [];

    protected array $equipamentos = [
        "cabeca" => null,
        "peito" => null,
        "perna" => null,
        "mao" => null
    ];


    function __construct($nome, $genero, $VidaBase, $dano)
    {
        $this->nome = $nome;

        $this->VidaBase = $VidaBase;
        $this->vida_maxima = $VidaBase;
        $this->vida_atual = $VidaBase;

        $this->dano = $dano;
        $this->dano_base = $dano;

        $this->genero = $genero;
    }


    function getNome()
    {
        return $this->nome;
    }


    function getGenero()
    {
        return $this->genero;
    }


    function getSalas()
    {
        return $this->SalasLiberadas;
    }


    function setSalas($salas)
    {
        $this->SalasLiberadas = $salas;
    }


    function liberarSala($sala)
    {
        if (!in_array($sala, $this->SalasLiberadas)) {
            $this->SalasLiberadas[] = $sala;
        }
    }


    function getInventario()
    {
        return $this->inventario;
    }


    function getEquipamentos()
    {
        return $this->equipamentos;
    }


    function colocaItem($item)
    {
        $this->inventario[] = $item;
    }


    function getDanoCausado()
    {
        return $this->dano_causado;
    }


    function adicionaDanoCausado($dano)
    {
        $this->dano_causado += $dano;
    }


    function atacar($inimigo)
    {
        $inimigo->recebe_dano($this->dano);

        $this->dano_causado += $this->dano;
    }


    function atualizaVida()
    {
        $vidaAnterior = $this->vida_maxima;

        $this->vida_maxima = $this->VidaBase;

        foreach ($this->equipamentos as $item) {

            if ($item instanceof armadura) {
                $this->vida_maxima += $item->getVidaExtra();
            }
        }

        $diferenca = $this->vida_maxima - $vidaAnterior;

        $this->vida_atual += $diferenca;

        if ($this->vida_atual < 0) {
            $this->vida_atual = 0;
        }

        if ($this->vida_atual > $this->vida_maxima) {
            $this->vida_atual = $this->vida_maxima;
        }
    }


    function equiparItem($item, $indice)
    {
        if (!method_exists($item, 'getSlot')) {
            return;
        }

        if (!isset($this->inventario[$indice])) {
            return;
        }

        $slot = $item->getSlot();

        if (!array_key_exists($slot, $this->equipamentos)) {
            return;
        }

        $itemAntigo = $this->equipamentos[$slot];

        if ($itemAntigo != null) {
            $this->inventario[] = $itemAntigo;
        }

        $this->equipamentos[$slot] = $item;

        unset($this->inventario[$indice]);

        $this->inventario = array_values($this->inventario);


        if ($item instanceof Arma) {

            $this->dano =
                $this->dano_base +
                $item->getDano();
        }


        if ($item instanceof armadura) {

            $this->atualizaVida();
        }
    }


    function desequiparItem($slot)
    {
        if (!array_key_exists($slot, $this->equipamentos)) {
            return;
        }

        $item = $this->equipamentos[$slot];

        if ($item != null) {

            $this->inventario[] = $item;

            $this->equipamentos[$slot] = null;
        }


        if ($slot == "mao") {

            $this->dano = $this->dano_base;
        }


        if ($slot != "mao") {

            $this->atualizaVida();
        }
    }


    function beberPocao($consumivel)
    {
        if (!($consumivel instanceof consumivel)) {
            return;
        }

        $cura = $consumivel->getCura();

        $this->vida_atual += $cura;

        if ($this->vida_atual > $this->vida_maxima) {
            $this->vida_atual = $this->vida_maxima;
        }


        $chave = array_search(
            $consumivel,
            $this->inventario,
            true
        );


        if ($chave !== false) {

            unset($this->inventario[$chave]);

            $this->inventario = array_values(
                $this->inventario
            );
        }
    }
}

?>