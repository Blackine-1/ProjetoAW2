<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

function inventario($jogador)
{

    $itens = $jogador->getInventario();
    $equipamentos = $jogador->getEquipamentos();

    echo "<div class='seguratuti'>";

    echo "<form method='POST'>
            <button type='submit' name='acao' value='fecharinventario'>Fechar</button>
          </form>";

    echo "<h2>Atributos</h2>";

    echo "<table>";

    echo "<tr>";
    echo "<th>Atributo</th>";
    echo "<th>Valor</th>";
    echo "</tr>";

    echo "<tr>";
    echo "<td>Nome</td>";
    echo "<td>" . $jogador->getNome() . "</td>";
    echo "</tr>";

    echo "<tr>";
    echo "<td>Gênero</td>";
    echo "<td>" . $jogador->getGenero() . "</td>";
    echo "</tr>";

    echo "<tr>";
    echo "<td>Vida</td>";
    echo "<td>" . $jogador->getvida() . " / " . $jogador->getvidamax() . "</td>";
    echo "</tr>";

    echo "<tr>";
    echo "<td>Vida Base</td>";
    echo "<td>" . $jogador->getVidaBase() . "</td>";
    echo "</tr>";

    echo "<tr>";
    echo "<td>Dano</td>";
    echo "<td>" . $jogador->getDano() . "</td>";
    echo "</tr>";

    echo "</table>";

    echo "<h2>Inventário</h2>";

    echo "<table>";

    echo "<tr>";
    echo "<th>Nome</th>";
    echo "<th>Raridade</th>";
    echo "<th>Dano/Vida</th>";
    echo "<th>Ação</th>";
    echo "</tr>";

    foreach ($itens as $indice => $item) {

        echo "<tr>";

        echo "<td>" . $item->getNome() . "</td>";
        echo "<td>" . $item->getRaridade() . "</td>";

        if ($item instanceof Arma) {

            echo "<td>+" . $item->getDano() . " dano</td>";

            echo "<td>";
            echo "<form method='post'>";
            echo "<input type='hidden' name='indice' value='" . $indice . "'>";
            echo "<button type='submit' name='acao' value='equipar'>Equipar</button>";
            echo "</form>";
            echo "</td>";

        } elseif ($item instanceof armadura) {

            echo "<td>+" . $item->getVidaExtra() . " vida</td>";

            echo "<td>";
            echo "<form method='post'>";
            echo "<input type='hidden' name='indice' value='" . $indice . "'>";
            echo "<button type='submit' name='acao' value='equipar'>Equipar</button>";
            echo "</form>";
            echo "</td>";

        } elseif ($item instanceof consumivel) {

            echo "<td>+" . $item->getCura() . " vida</td>";

            echo "<td>";
            echo "<form method='post'>";
            echo "<input type='hidden' name='indice' value='" . $indice . "'>";
            echo "<button type='submit' name='acao' value='usar'>Usar</button>";
            echo "</form>";
            echo "</td>";

        }

        echo "</tr>";
    }

    echo "</table>";

    echo "<h2>Equipamentos</h2>";

    echo "<table>";

    echo "<tr>";
    echo "<th>Slot</th>";
    echo "<th>Item</th>";
    echo "<th>Raridade</th>";
    echo "<th>Dano/Vida</th>";
    echo "<th>Ação</th>";
    echo "</tr>";

    foreach ($equipamentos as $slot => $item) {

        echo "<tr>";

        echo "<td>" . $slot . "</td>";

        if ($item != null) {

            echo "<td>" . $item->getNome() . "</td>";
            echo "<td>" . $item->getRaridade() . "</td>";

            if ($item instanceof Arma) {
                echo "<td>+" . $item->getDano() . " dano</td>";
            } elseif ($item instanceof armadura) {
                echo "<td>+" . $item->getVidaExtra() . " vida</td>";
            }

            echo "<td>";
            echo "<form method='post'>";
            echo "<input type='hidden' name='slot' value='" . $slot . "'>";
            echo "<button type='submit' name='acao' value='desequipar'>Desequipar</button>";
            echo "</form>";
            echo "</td>";

        } else {

            echo "<td>Vazio</td>";
            echo "<td>-</td>";
            echo "<td>-</td>";
            echo "<td>-</td>";

        }

        echo "</tr>";
    }

    echo "</table>";

    echo "</div>";
}

?>