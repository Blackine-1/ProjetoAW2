<?php

class gerador {

    private array $nomes = [
        "Errante",
        "Saqueador",
        "Caçador",
        "Mercenário",
        "Renegado",
        "Bandido",
        "Soldado",
        "Guerreiro",
        "Desafiante",
        "Ameaça",
        "Vagante",
        "Brutamontes",
        "Combatente",
        "Salteador",
        "Perseguidor"
    ];

    private array $imagens = [
        "token_1.png",
        "token_2.png",
        "token_3.png",
        "token_4.png"
    ];

    private array $classesVida = [
        "Frágil",
        "Resistente",
        "Robusto",
        "Fortificado",
        "Colossal"
    ];

    private array $classesDano = [
        "Fraco",
        "Agressivo",
        "Perigoso",
        "Brutal",
        "Devastador"
    ];

    private array $raridades = [

        "Comum" => [
            "chance" => 40,
            "vida" => [40, 80],
            "dano" => [5, 15]
        ],

        "Incomum" => [
            "chance" => 25,
            "vida" => [70, 110],
            "dano" => [10, 20]
        ],

        "Raro" => [
            "chance" => 15,
            "vida" => [100, 150],
            "dano" => [15, 25]
        ],

        "Épico" => [
            "chance" => 10,
            "vida" => [140, 200],
            "dano" => [20, 30]
        ],

        "Lendário" => [
            "chance" => 6,
            "vida" => [190, 260],
            "dano" => [25, 40]
        ],

        "Mítico" => [
            "chance" => 3,
            "vida" => [250, 330],
            "dano" => [35, 50]
        ],

        "Divino" => [
            "chance" => 1,
            "vida" => [320, 400],
            "dano" => [45, 60]
        ]

    ];

    function escolherRaridade() {

        $numero = rand(1, 100);

        $acumulado = 0;

        foreach($this->raridades as $nome => $dados) {

            $acumulado += $dados["chance"];

            if($numero <= $acumulado) {
                return $nome;
            }

        }

    }

    function gerar() {

        $nome = $this->nomes[array_rand($this->nomes)];

        $imagem = $this->imagens[array_rand($this->imagens)];

        $classeVida = $this->classesVida[array_rand($this->classesVida)];

        $classeDano = $this->classesDano[array_rand($this->classesDano)];

        $raridade = $this->escolherRaridade();

        $vida = rand(
            $this->raridades[$raridade]["vida"][0],
            $this->raridades[$raridade]["vida"][1]
        );

        $dano = rand(
            $this->raridades[$raridade]["dano"][0],
            $this->raridades[$raridade]["dano"][1]
        );

        return new inimigo(
            $nome,
            $vida,
            $dano,
            $classeVida,
            $classeDano,
            $imagem
        );
    }
}

?>