<?php 
class consumivel {
    protected string $nome;
    protected int $cura;
    protected string $raridade;

    function __construct($nome, $cura, $raridade){
        $this->nome = $nome;
        $this->cura = $cura;
        $this->raridade = $raridade;
    }
    function getNome(){
        return $this->nome;
    }
    function getCura(){
        return $this->cura;
    }
    function getRaridade(){
        return $this->raridade;
    }
}

?>