<?php 

require_once "personagens/base.php"; 
require_once "itens.php"; 

class jogador extends base { 

    protected string $genero; 

    protected int $dano_base; 

    protected array $SalasLiberadas = []; 

    protected array $inventario = []; 

    protected array $equipamentos = [ 
        "cabeca" => null, 
        "peito" => null, 
        "perna" => null, 
        "mao" => null 
    ]; 


    function __construct($nome, $genero, $VidaBase, $dano) { 

        $this->nome = $nome; 

        $this->VidaBase = $VidaBase; 
        $this->vida_maxima = $VidaBase; 
        $this->vida_atual = $VidaBase; 

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


    function atualizaVida() {

        $vidaAnterior = $this->vida_maxima;

        $this->vida_maxima = $this->VidaBase;

        foreach ($this->equipamentos as $item) {

            if ($item instanceof armadura) {

                $this->vida_maxima += $item->getVidaExtra();

            }
        }

        $diferenca = $this->vida_maxima - $vidaAnterior;

        $this->vida_atual += $diferenca;

        if ($this->vida_atual > $this->vida_maxima) {

            $this->vida_atual = $this->vida_maxima;
        }
    }   
    function equiparItem($item) { 

        $slot = $item->getSlot(); 

        if (array_key_exists($slot, $this->equipamentos)) { 

            $this->equipamentos[$slot] = $item; 

            if ($item instanceof Arma) { 

                $this->dano = $this->dano_base + $item->getDano(); 
            } 

            if ($item instanceof armadura) { 

                $this->atualizaVida(); 
            } 
        } 
    } 
             

    function desequiparItem($slot) { 

        if (array_key_exists($slot, $this->equipamentos)) { 

            $this->equipamentos[$slot] = null; 

            if ($slot == "mao") { 

                $this->dano = $this->dano_base; 
            } 

            if ($slot != "mao") { 

                $this->atualizaVida(); 
            } 
        } 
    } 

} 

?>