<?php

require_once "inimigos.php";

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
    "Ameaça"
];
    private array $classesVida = [
        "Ínfimo"      => [1, 20],
        "Menor"       => [21, 50],
        "Comum"       => [51, 90],
        "Superior"    => [91, 140],
        "Maior"       => [141, 200],
        "Excepcional" => [201, 260],
        "Monstruoso"  => [261, 320],
        "Titânico"    => [321, 350],
        "Colossal"    => [351, 380],
        "Abissal"     => [381, 400]
    ];

    private array $classesDano = [
        "Iniciante"     => [1, 14],
        "Intermediário" => [15, 34],
        "Avançado"      => [35, 59],
        "Santo"         => [60, 84],
        "Rei"           => [85, 109],
        "Imperador"     => [110, 129],
        "Deus"          => [130, 149]
    ];


    function descobrirClasse($valor, $classes) {

        foreach ($classes as $nome => $limites) {

            if ($valor >= $limites[0] && $valor <= $limites[1]) {
                return $nome;
            }

        }

    }


    function gerar() {
        $nome = $this->nomes[array_rand($this->nomes)];

        $vida = rand(1, 400);
        $dano = rand(1, 149);

        $classeVida = $this->descobrirClasse($vida, $this->classesVida);
        $classeDano = $this->descobrirClasse($dano, $this->classesDano);

        return new inimigo(
            $nome,
            $vida,
            $dano,
            $classeVida,
            $classeDano
            );
    }
}

?>