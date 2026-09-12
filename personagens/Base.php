<?php 

class base { 

    protected string $nome; 
    protected int $VidaBase; 
    protected int $vida_maxima;
    protected int $vida_atual; 
    protected int $dano; 
    protected bool $morto = false; 


    function recebe_dano($dano_recebido) { 

        $this->vida_atual -= $dano_recebido; 

        if ($this->vida_atual <= 0) { 
            $this->vida_atual = 0; 
            $this->morto = true; 
        } 
    } 


    function atacar($inimigo) { 

        $inimigo->recebe_dano($this->dano); 
    } 


    function getvida() { 

        return $this->vida_atual; 
    } 


    function getvidamax() { 

        return $this->vida_maxima; 
    }


    function getVidaBase() { 

        return $this->VidaBase; 
    }


    function getmorto() { 

        return $this->morto; 
    } 


    function getDano() { 

        return $this->dano; 
    } 

    function setVida($valor){
    $this->vida_atual = $valor;
    $this->morto = false;
}
} 

?>