<?php

function liberarProximasSalas($jogador, $sala) {

    $proximasSalas = [
        11 => [12],
        12 => [7, 17],
        7  => [8],
        8  => [9],
        9  => [10],
        17 => [18],
        18 => [19],
        19 => [20],
        20 => [15]
    ];

    if (isset($proximasSalas[$sala])) {

        foreach ($proximasSalas[$sala] as $proxima) {
            $jogador->liberarSala($proxima);
        }

    }
}