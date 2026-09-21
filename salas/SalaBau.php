<?php

require_once "../config.php";

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (!isset($_SESSION['jogador'])) {
    header("Location: ../index.php");
    exit;
}

if (!isset($_SESSION['SalaAtual'])) {
    header("Location: ../labirinto.php");
    exit;
}

$jogador = $_SESSION['jogador'];

$sala = $_SESSION['SalaAtual'];

$inventarioaberto = false;

$artifice = new artifice();

if (!isset($_SESSION['baus_abertos'])) {
    $_SESSION['baus_abertos'] = [];
}

if (!isset($_SESSION['itensbau'][$sala])) {
    $_SESSION['itensbau'][$sala] = (int) ((rand(1, 9) + rand(1, 9)) / 2);
}

$itens = $_SESSION['itensbau'][$sala];

$bauaberto = isset($_SESSION['baus_abertos'][$sala]);

$vitoria = false;

if (
    isset($_POST['acao']) &&
    isset($_POST['indice'])
) {

    $indice = (int) $_POST['indice'];

    $itensInventario = $jogador->getInventario();

    if (isset($itensInventario[$indice])) {

        $item = $itensInventario[$indice];

        if ($_POST['acao'] == 'equipar') {

            $jogador->equiparItem($item, $indice);

        } elseif ($_POST['acao'] == 'usar') {

            if ($item instanceof consumivel) {
                $jogador->beberPocao($item);
            }
        }

        $_SESSION['jogador'] = $jogador;

        $inventarioaberto = true;
    }
}

if (
    isset($_POST['acao']) &&
    $_POST['acao'] == 'desequipar' &&
    isset($_POST['slot'])
) {

    $slot = $_POST['slot'];

    $jogador->desequiparItem($slot);

    $_SESSION['jogador'] = $jogador;

    $inventarioaberto = true;
}

if (
    isset($_POST['acao']) &&
    $_POST['acao'] == 'inventario'
) {

    $inventarioaberto = true;
}

if (
    isset($_POST['acao']) &&
    $_POST['acao'] == 'fecharinventario'
) {

    $inventarioaberto = false;
}

if (!$bauaberto) {

    if (
        isset($_POST['acao']) &&
        $_POST['acao'] == 'abrir'
    ) {

        for ($i = 1; $i <= $itens; $i++) {

            $item = $artifice->gerar();

            $jogador->colocaItem($item);
        }

        $_SESSION['baus_abertos'][$sala] = true;

        $_SESSION['jogador'] = $jogador;

        $bauaberto = true;
    }
}

if (
    isset($_POST['acao']) &&
    $_POST['acao'] == 'sair'
) {

    $vitoria = true;

    liberarProximasSalas($jogador, $sala);

    $_SESSION['jogador'] = $jogador;
}

?>

<!DOCTYPE html>

<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php if ($vitoria) { ?>

        <meta http-equiv="refresh" content="2;url=../labirinto.php">

    <?php } ?>

    <title>Sala dos Tesouros</title>

    <link rel="stylesheet" href="../css/tesouro.css">

    <link rel="stylesheet" href="../css/inventario.css">

</head>

<body>

    <h1>Sala dos Tesouros</h1>

    <?php if (!$inventarioaberto) { ?>

        <main>

            <?php if ($vitoria) { ?>

                <h2>Você venceu!</h2>

                <p>Voltando para o labirinto...</p>

            <?php } ?>

            <?php if (!$vitoria) { ?>

                <section class="acoes">

                    <form method="POST">

                        <?php if (!$bauaberto) { ?>

                            <button type="submit" name="acao" value="abrir">
                                Abrir
                            </button>

                        <?php } else { ?>

                            <p>O baú já foi aberto.</p>

                        <?php } ?>

                        <button type="submit" name="acao" value="inventario">
                            Inventário
                        </button>

                        <button type="submit" name="acao" value="sair">
                            Sair
                        </button>

                    </form>

                </section>

            <?php } ?>

        </main>

    <?php } ?>

    <?php if ($inventarioaberto) { ?>

        <?php inventario($jogador); ?>

    <?php } ?>

</body>

</html>