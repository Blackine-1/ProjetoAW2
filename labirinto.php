<?php

require_once "config.php";

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (!isset($_SESSION['jogador'])) {
    header("Location: index.php");
    exit;
}

$jogador = $_SESSION['jogador'];

if (
    isset($_SESSION['combate_sala']) &&
    isset($_SESSION['combate_finalizado']) &&
    $_SESSION['combate_finalizado'] == true
) {
    unset($_SESSION['inimigo']);
    unset($_SESSION['drop']);
    unset($_SESSION['turno']);
    unset($_SESSION['cdforte']);
    unset($_SESSION['combate_finalizado']);
    unset($_SESSION['combate_sala']);

    $_SESSION['jogador'] = $jogador;
}

if (!isset($_SESSION['inicio'])) {
    $_SESSION['inicio'] = time();
}

$salas = [
    7,
    8,
    9,
    10,
    11,
    12,
    15,
    17,
    18,
    19,
    20
];

$inventarioaberto = false;

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

?>

<!DOCTYPE html>

<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Labirinto</title>

    <link rel="stylesheet" href="css/labirinto.css">

    <link rel="stylesheet" href="css/inventario.css">

</head>

<body>

<?php if (!$inventarioaberto) { ?>

    <div class="labirinto">

        <div class="caminho caminho-11-12"></div>
        <div class="caminho caminho-12-7"></div>
        <div class="caminho caminho-7-8"></div>
        <div class="caminho caminho-8-9"></div>
        <div class="caminho caminho-9-10"></div>
        <div class="caminho caminho-10-15"></div>
        <div class="caminho caminho-12-17"></div>
        <div class="caminho caminho-17-18"></div>
        <div class="caminho caminho-18-19"></div>
        <div class="caminho caminho-19-20"></div>
        <div class="caminho caminho-20-15"></div>

        <?php

        for ($i = 1; $i <= 25; $i++) {

            if (in_array($i, $salas)) {

                if (in_array($i, $jogador->getSalas())) {

                    echo "<a href='dados.php?sala=$i' class='sala-$i'>";
                    echo "<div class='sala-liberada'>$i</div>";
                    echo "</a>";

                } else {

                    echo "<div class='sala-bloqueada sala-$i'>$i</div>";

                }
            }
        }

        ?>

        <form method="POST">

            <button
                type="submit"
                name="acao"
                value="inventario"
            >
                Inventário
            </button>

        </form>

    </div>

<?php } ?>

<?php if ($inventarioaberto) { ?>

    <?php inventario($jogador); ?>

<?php } ?>

</body>

</html>