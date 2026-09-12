<?php 
class consumivel {
    protected string $nome;
    protected int $cura;

    function __construct($nome, $cura){
        $this->nome = $nome;
        $this->cura = $cura;

    }

    function getCura(){
        return $this->cura;
    }
    
}

?>