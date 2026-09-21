<?php

require_once "../config.php";

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (
    isset($_POST['acao']) &&
    $_POST['acao'] == 'finalizar'
) {

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

    header("Location: ../index.php");
    exit;
}

?>

<!DOCTYPE html>

<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/sala.css">

    <title>Final</title>

</head>

<body>

    <main class="sala">

        <h1>A Relíquia</h1>

        <img src="../imagens/reliquia.gif" alt="Relíquia">

        <p>
            Após derrotar a criatura que protegia a relíquia,
            você finalmente consegue se aproximar dela.
        </p>

        <p>
            Ao observar o objeto, percebe antigas inscrições
            espalhadas por sua superfície. Elas revelam que
            aquela relíquia nunca foi criada para trazer riqueza
            ou fama.
        </p>

        <p>
            Seu verdadeiro propósito era escolher alguém capaz
            de utilizar seu poder com responsabilidade.
        </p>

        <p>
            Ao tocar a relíquia, uma enorme quantidade de poder
            percorre seu corpo. Você percebe que agora possui
            uma força capaz de mudar completamente sua vida.
        </p>

        <p>
            Porém, em vez de buscar riquezas ou reconhecimento,
            decide usar esse poder para ajudar aqueles que
            precisam.
        </p>

        <p>
            Você retorna para sua vila e passa a protegê-la,
            ajudando seus habitantes e trazendo prosperidade
            para o lugar onde sua aventura começou.
        </p>

        <p>
            Com o tempo, sua história se espalha e você passa
            a ser conhecido como um verdadeiro herói.
        </p>

        <p>
            No fim, você entende que a verdadeira grandeza
            não está no poder que alguém possui, mas na forma
            como decide utilizá-lo.
        </p>

        <p>
            E essa é apenas a primeira de muitas aventuras
            que ainda estão por vir.
        </p>

        <form method="POST">

            <button type="submit" name="acao" value="finalizar">
                Finalizar
            </button>

        </form>

    </main>

</body>

</html>