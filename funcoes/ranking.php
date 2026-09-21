<?php

function salvarRanking($nome, $tempo, $dano)
{
    $conn = DBConfig::getConn();

    $sql = "INSERT INTO ranking (nome, tempo_conclusao, dano)
            VALUES (:nome, :tempo, :dano)";

    $stmt = $conn->prepare($sql);

    $stmt->execute([
        ":nome" => $nome,
        ":tempo" => $tempo,
        ":dano" => $dano
    ]);
}

function finalizarRanking($jogador)
{
    if (isset($_SESSION['ranking_salvo'])) {
        return;
    }

    $tempo = time() - $_SESSION['inicio'];

    $horas = floor($tempo / 3600);
    $minutos = floor(($tempo % 3600) / 60);
    $segundos = $tempo % 60;

    $tempoFormatado = sprintf(
        "%02d:%02d:%02d",
        $horas,
        $minutos,
        $segundos
    );

    salvarRanking(
        $jogador->getNome(),
        $tempoFormatado,
        $jogador->getDanoCausado()
    );

    $_SESSION['ranking_salvo'] = true;
}

?>