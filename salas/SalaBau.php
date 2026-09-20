<?php 

require_once "../config.php"; 
require_once "../funcoes/inventario.php";

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$jogador = $_SESSION['jogador'];  

$inventarioaberto = false; 

$artifice = new artifice(); 


if (!isset($_SESSION['itensbau'])) {
    $_SESSION['itensbau'] = (int)((rand(1, 9) + rand(1, 9)) / 2);
}

$itens = $_SESSION['itensbau'];


if (!isset($_SESSION['bauaberto'])) {
    $_SESSION['bauaberto'] = false;
}

$bauaberto = $_SESSION['bauaberto'];

$vitoria = false;


if (isset($_POST['acao']) && $_POST['acao'] == 'inventario') {
    $inventarioaberto = true;
}


if (isset($_POST['acao']) && $_POST['acao'] == 'fecharinventario') {
    $inventarioaberto = false;
}


if ($bauaberto == false) {

    if (isset($_POST['acao']) && $_POST['acao'] == 'abrir') {

        for ($i = 1; $i <= $itens; $i++) {

            $item = $artifice->gerar();

            $jogador->colocaItem($item);
        }

        $_SESSION['bauaberto'] = true;

        unset($_SESSION['itensbau']);

        $_SESSION['jogador'] = $jogador;

        $bauaberto = true;
    }
}


if (isset($_POST['acao']) && $_POST['acao'] == 'sair') {
    $vitoria = true;
    $sala = $_SESSION['SalaAtual'];
    liberarProximasSalas($jogador, $sala);
    unset($_SESSION['bauaberto']);
}

?>

<!DOCTYPE html> 
<html lang="en"> 

<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 

    <?php if($vitoria){ ?>    
        <meta http-equiv="refresh" content="2;url=../labirinto.php">    
    <?php } ?>   

    <title>Sala dos Tesouros</title> 
    <link rel="stylesheet" href="../css/tesouro.css">
    <link rel="stylesheet" href="../css/inventario.css">
</head> 

<body> 

    <h1>Sala dos Tesouros</h1> 


    <?php if($inventarioaberto == false){ ?>

        <main> 

            <?php if($vitoria){ ?>    

                <h1>Você venceu!</h1>    
                <p>Voltando para o labirinto...</p>    

            <?php } ?>


            <?php if(!$vitoria){ ?> 

                <section class="acoes"> 

                    <form method="POST"> 

                        <?php if($bauaberto == false){ ?>

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


    <?php if($inventarioaberto == true){ 
        inventario($jogador); 
    } ?>


</body> 
</html>