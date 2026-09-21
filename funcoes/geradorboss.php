<?php

class geradorboss {

    private array $nomes = [
        "Beholder",
        "Colosso",
        "Devorador",
        "Guardião",
        "Abominação"
    ];

    private array $imagens = [
        "beholder.png",
        "colosso.png",
        "devorador.png",
        "guardiao.png",
        "abominacao.png"
    ];

    private array $bosses = [

        "Beholder" => [
            "vida" => [450, 550],
            "dano" => [30, 40]
        ],

        "Colosso" => [
            "vida" => [500, 650],
            "dano" => [25, 35]
        ],

        "Devorador" => [
            "vida" => [400, 500],
            "dano" => [35, 45]
        ],

        "Guardião" => [
            "vida" => [550, 700],
            "dano" => [20, 30]
        ],

        "Abominação" => [
            "vida" => [450, 600],
            "dano" => [30, 45]
        ]

    ];

    function gerar() {

        $indice = array_rand($this->nomes);

        $nome = $this->nomes[$indice];
        $imagem = $this->imagens[$indice];

        $vida = rand(
            $this->bosses[$nome]["vida"][0],
            $this->bosses[$nome]["vida"][1]
        );

        $dano = rand(
            $this->bosses[$nome]["dano"][0],
            $this->bosses[$nome]["dano"][1]
        );

        return new inimigo(
            $nome,
            $vida,
            $dano,
            "",
            "",
            $imagem
        );
    }
}

?>