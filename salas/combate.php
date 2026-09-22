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

if (
    !isset($_SESSION['combate_sala']) ||
    $_SESSION['combate_sala'] != $_SESSION['SalaAtual']
) {
    unset($_SESSION['inimigo']);
    unset($_SESSION['drop']);
    unset($_SESSION['turno']);
    unset($_SESSION['cdforte']);
    unset($_SESSION['combate_finalizado']);

    $_SESSION['combate_sala'] = $_SESSION['SalaAtual'];
    $_SESSION['combate_finalizado'] = false;
}

$vitoria = false;
$derrotado = false;
$inventarioaberto = false;
$redirecionar = false;

if (!isset($_SESSION['combate_finalizado'])) {
    $_SESSION['combate_finalizado'] = false;
}

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

if (
    isset($_POST['acao']) &&
    $_POST['acao'] == 'pegar_drop'
) {

    if (
        isset($_SESSION['drop']) &&
        $_SESSION['drop'] != null
    ) {

        $jogador->colocaItem($_SESSION['drop']);

        $sala = $_SESSION['SalaAtual'];

        liberarProximasSalas($jogador, $sala);

        $_SESSION['jogador'] = $jogador;

        header("Location: ../labirinto.php");
        exit;
    }
}

if (!isset($_SESSION['turno'])) {
    $_SESSION['turno'] = "jogador";
}

if (!isset($_SESSION['cdforte'])) {
    $_SESSION['cdforte'] = 0;
}

if (
    !isset($_SESSION['inimigo']) &&
    $_SESSION['combate_finalizado'] == false
) {

    $gerador = new gerador();

    $_SESSION['inimigo'] = $gerador->gerar();

    $artifice = new artifice();

    if (rand(1, 100) <= 30) {
        $_SESSION['drop'] = $artifice->gerar();
    } else {
        $_SESSION['drop'] = null;
    }

    $_SESSION['cdforte'] = 0;
}

$inimigo = $_SESSION['inimigo'] ?? null;

if (
    $_SESSION['combate_finalizado'] == true &&
    $inimigo === null
) {

    $vitoria = true;

    if (
        !isset($_SESSION['drop']) ||
        $_SESSION['drop'] == null
    ) {
        $redirecionar = true;
    }
}

if (
    !$inventarioaberto &&
    $_SESSION['turno'] == "jogador" &&
    $_SESSION['combate_finalizado'] == false &&
    $inimigo !== null
) {

    if (
        isset($_POST['acao']) &&
        $_POST['acao'] == 'atacar'
    ) {

        $jogador->atacar($inimigo);

        if ($inimigo->getmorto() == true) {

            unset($_SESSION['inimigo']);

            $_SESSION['jogador'] = $jogador;

            $sala = $_SESSION['SalaAtual'];

            liberarProximasSalas($jogador, $sala);

            $_SESSION['turno'] = "jogador";
            $_SESSION['combate_finalizado'] = true;

            $vitoria = true;

            if (
                !isset($_SESSION['drop']) ||
                $_SESSION['drop'] == null
            ) {
                $redirecionar = true;
            }

        } else {

            $_SESSION['turno'] = "inimigo";
            $_SESSION['jogador'] = $jogador;
            $_SESSION['inimigo'] = $inimigo;

            header("Location: combate.php");
            exit;
        }
    }

    if (
        isset($_POST['acao']) &&
        $_POST['acao'] == 'ataque_forte'
    ) {

        if ($_SESSION['cdforte'] == 0) {

            $dano = $jogador->getDano() * 2;

            $inimigo->recebe_dano($dano);

            $jogador->adicionaDanoCausado($dano);

            $_SESSION['cdforte'] = 3;

            if ($inimigo->getmorto() == true) {

                unset($_SESSION['inimigo']);

                $_SESSION['jogador'] = $jogador;

                $sala = $_SESSION['SalaAtual'];

                liberarProximasSalas($jogador, $sala);

                $_SESSION['turno'] = "jogador";
                $_SESSION['combate_finalizado'] = true;

                $vitoria = true;

                if (
                    !isset($_SESSION['drop']) ||
                    $_SESSION['drop'] == null
                ) {
                    $redirecionar = true;
                }

            } else {

                $_SESSION['turno'] = "inimigo";
                $_SESSION['jogador'] = $jogador;
                $_SESSION['inimigo'] = $inimigo;

                header("Location: combate.php");
                exit;
            }
        }
    }

    if (
        isset($_POST['acao']) &&
        $_POST['acao'] == 'fugir'
    ) {

        unset($_SESSION['inimigo']);
        unset($_SESSION['drop']);
        unset($_SESSION['turno']);
        unset($_SESSION['cdforte']);
        unset($_SESSION['combate_finalizado']);
        unset($_SESSION['combate_sala']);

        header("Location: ../labirinto.php");
        exit;
    }
}

if (
    !$inventarioaberto &&
    $_SESSION['turno'] == "inimigo" &&
    $_SESSION['combate_finalizado'] == false &&
    $inimigo !== null
) {

    if (
        isset($_POST['acao']) &&
        $_POST['acao'] == 'turno_inimigo'
    ) {

        $inimigo->atacar($jogador);

        if ($jogador->getmorto() == true) {

            unset($_SESSION['jogador']);
            unset($_SESSION['inimigo']);
            unset($_SESSION['drop']);
            unset($_SESSION['turno']);
            unset($_SESSION['desafios']);
            unset($_SESSION['inicio']);
            unset($_SESSION['tempo_conclusao']);
            unset($_SESSION['dano_conclusao']);
            unset($_SESSION['SalaAtual']);
            unset($_SESSION['itensbau']);
            unset($_SESSION['bauaberto']);
            unset($_SESSION['cdforte']);
            unset($_SESSION['combate_finalizado']);
            unset($_SESSION['combate_sala']);

            $derrotado = true;

        } else {

            if ($_SESSION['cdforte'] > 0) {
                $_SESSION['cdforte']--;
            }

            $_SESSION['jogador'] = $jogador;
            $_SESSION['inimigo'] = $inimigo;
            $_SESSION['turno'] = "jogador";

            header("Location: combate.php");
            exit;
        }
    }
}

?>

<!DOCTYPE html>

<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/combate.css">
    <script src="../js/musica.js"></script>
    <link rel="stylesheet" href="../css/inventario.css">
    <link rel="stylesheet" href="../css/musica.css">
    <script src="../js/combate.js"></script>

    <?php if ($redirecionar) { ?>

        <meta http-equiv="refresh" content="2;url=../labirinto.php">

    <?php } ?>

    <?php if ($derrotado) { ?>

        <meta http-equiv="refresh" content="2;url=../index.php">

    <?php } ?>

    <title>Combate</title>

</head>

<body>

    <?php if (!$inventarioaberto) { ?>

        <main class="combate">

            <?php if ($vitoria) { ?>

                <h1>Você venceu!</h1>

                <?php if (
                    isset($_SESSION['drop']) &&
                    $_SESSION['drop'] != null
                ) { ?>

                    <h2>O inimigo deixou um item!</h2>

                    <p>
                        <?php echo $_SESSION['drop']->getNome(); ?>
                    </p>

                    <p>
                        Raridade:
                        <?php echo $_SESSION['drop']->getRaridade(); ?>
                    </p>

                    <?php if ($_SESSION['drop'] instanceof Arma) { ?>

                        <p>
                            +<?php echo $_SESSION['drop']->getDano(); ?> dano
                        </p>

                    <?php } elseif ($_SESSION['drop'] instanceof armadura) { ?>

                        <p>
                            +<?php echo $_SESSION['drop']->getVidaExtra(); ?> vida
                        </p>

                    <?php } elseif ($_SESSION['drop'] instanceof consumivel) { ?>

                        <p>
                            +<?php echo $_SESSION['drop']->getCura(); ?> vida
                        </p>

                    <?php } ?>

                    <form method="POST">

                        <button type="submit" name="acao" value="pegar_drop">
                            Pegar item
                        </button>

                    </form>

                <?php } else { ?>

                    <p>O inimigo não deixou nenhum item.</p>

                    <p>Voltando para o labirinto...</p>

                <?php } ?>

            <?php } elseif ($derrotado) { ?>

                <h1>Você foi derrotado!</h1>

                <p>Voltando para a tela inicial...</p>

            <?php } else { ?>

                <p id="mensagem"></p>

                <section class="personagens">

                    <div class="jogador">

                        <img
                            src="../imagens/cavaleiro.gif"
                            alt="Jogador"
                        >

                        <p>
                            Vida:
                            <?php echo $jogador->getvida(); ?>
                            /
                            <?php echo $jogador->getvidamax(); ?>
                        </p>

                    </div>

                    <div class="inimigo">

                        <img
                            src="../imagens/inimigos/<?php echo $inimigo->getImagem(); ?>"
                            alt="<?php echo $inimigo->getNome(); ?>"
                        >

                        <p>

                            <?php

                            echo $inimigo->getNome() . ' ' .
                                $inimigo->getClasseDano() . ' ' .
                                $inimigo->getClasseVida() .
                                "<br>";

                            ?>

                            Vida:
                            <?php echo $inimigo->getvida(); ?>
                            /
                            <?php echo $inimigo->getvidamax(); ?>

                        </p>

                    </div>

                </section>

                <section class="acoes">

                    <form method="POST">

                        <button
                            type="button"
                            name="acao"
                            value="atacar"
                            onclick="atacar(this.form)"
                        >
                            Atacar
                        </button>

                        <button
                            type="submit"
                            name="acao"
                            value="ataque_forte"
                            <?php if ($_SESSION['cdforte'] > 0) {
                                echo "disabled";
                            } ?>
                        >
                            Ataque forte

                            <?php if ($_SESSION['cdforte'] > 0) { ?>

                                (<?php echo $_SESSION['cdforte']; ?>)

                            <?php } ?>

                        </button>

                        <button
                            type="submit"
                            name="acao"
                            value="inventario"
                        >
                            Inventário
                        </button>

                        <button
                            type="submit"
                            name="acao"
                            value="fugir"
                        >
                            Fugir
                        </button>

                    </form>

                </section>

            <?php } ?>

        </main>

        <?php if (
            isset($_SESSION['turno']) &&
            $_SESSION['turno'] == "inimigo" &&
            !$vitoria &&
            !$derrotado
        ) { ?>

            <script>
                turnoInimigo();
            </script>

        <?php } ?>

    <?php } ?>

    <?php if ($inventarioaberto) { ?>

        <?php inventario($jogador); ?>

    <?php } ?>

</body>

</html>