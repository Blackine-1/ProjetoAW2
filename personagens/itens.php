<?php  

class Item {  

    protected string $nome;  
    protected string $tipo;  
    protected string $slot; 
    protected string $raridade;

    function __construct($nome, $slot, $raridade) {  
        $this->nome = $nome;   
        $this->slot = $slot;  
        $this->raridade = $raridade;
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

    function getRaridade() {
        return $this->raridade;
    }
}  
  
  
class Arma extends Item {  
  
    protected int $dano; 
 
    function __construct($nome, $dano, $raridade) {  
        parent::__construct($nome, "mao", $raridade);  
        $this->dano = $dano;  
    }  
  
    function getDano() {  
        return $this->dano;  
    }  
}


class armadura extends Item { 

    protected int $VidaExtra; 
 
    function __construct($nome, $slot, $VidaExtra, $raridade){ 
        parent::__construct($nome, $slot, $raridade); 
        $this->VidaExtra = $VidaExtra; 
    } 

    function getVidaExtra() {  
        return $this->VidaExtra;  
    }  
} 
 
?>
