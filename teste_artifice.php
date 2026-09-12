
<?php

require_once "personagens/artifice.php";

$artifice = new artifice();

$itens = [];

for($i = 0; $i < 20; $i++){
    $itens[] = $artifice->gerar();
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/teste_artifice.css">

    <title>Teste de Itens</title>

</head>

<body>

    <main class="teste">

        <header>

            <h1>Gerador de Itens</h1>

            <p>20 itens gerados aleatoriamente</p>

        </header>


        <section class="itens">

            <?php foreach($itens as $item){ ?>

                <article class="item">

                    <div class="item-cabecalho">

                        <h2>
                            <?php echo $item->getNome(); ?>
                        </h2>

                        <span class="raridade">
                            <?php echo $item->getRaridade(); ?>
                        </span>

                    </div>


                    <div class="informacoes">

                        <p>
                            <strong>Slot:</strong>
                            <?php echo $item->getSlot(); ?>
                        </p>


                        <?php if($item instanceof Arma){ ?>

                            <p>
                                <strong>Dano:</strong>
                                <?php echo $item->getDano(); ?>
                            </p>

                        <?php } ?>


                        <?php if($item instanceof armadura){ ?>

                            <p>
                                <strong>Vida extra:</strong>
                                <?php echo $item->getVidaExtra(); ?>
                            </p>

                        <?php } ?>

                    </div>

                </article>

            <?php } ?>

        </section>

    </main>

</body>

</html>
