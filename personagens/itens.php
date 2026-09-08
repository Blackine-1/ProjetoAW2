<?php 
 
class Item { 
 
    protected string $nome; 
    protected string $tipo; 
    protected string $slot; 

    function __construct($nome,$slot) { 
        $this->nome = $nome;  
        $this->slot = $slot; 
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

    function __construct($nome, $dano) { 
        parent::__construct($nome, "mao"); 
        $this->dano = $dano; 
    } 
 
    function getDano() { 
        return $this->dano; 
    } 
} 
class armadura extends item{
    protected int $VidaExtra;

    function __construct($nome, $slot, $VidaExtra){
        parent::__construct($nome, $slot);
        $this->VidaExtra = $VidaExtra;
    }
        function getVidaExtra() { 
        return $this->VidaExtra; 
    } 
}

?>