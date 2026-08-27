<?php 

class base {
protected string $nome;
protected int $vida_maxima;
protected int $vida_atual ;
protected int $dano;
protected bool $morto = false;


function recebe_dano($dano_recebido){
    $this->vida_atual -= $dano_recebido;

    if($this->vida_atual <= 0){
        $this->morto = true;
    }
}
function atacar($inimigo){
    $inimigo->recebe_dano($this->dano) ;
}

function getvida(){
    return $this->vida_atual;
}

function getmorto(){
    return $this->morto;
}

}

?>