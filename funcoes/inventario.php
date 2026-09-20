<?php  
 
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
} 
 
$jogador = $_SESSION['jogador'];  
 
function inventario($jogador) {  
 
    $itens = $jogador->getInventario();  
    $equipamentos = $jogador->getEquipamentos();

<<<<<<< HEAD
    echo "<div class='seguratuti'>"; 
=======
    echo "<div class='seguratuti'>";
>>>>>>> d883c318f227af299450e5d99bc07c60b967da25
    
    echo "<form method='POST'>
            <button type='submit' name='acao' value='fecharinventario'>Fechar</button>
          </form>";           
    

    // INVENTÁRIO
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
        }  
 
        elseif ($item instanceof armadura) {  
            echo "<td>+" . $item->getVidaExtra() . " vida</td>";  
 
            echo "<td>"; 
            echo "<form method='post'>"; 
            echo "<input type='hidden' name='indice' value='" . $indice . "'>"; 
            echo "<button type='submit' name='acao' value='equipar'>Equipar</button>"; 
            echo "</form>"; 
            echo "</td>"; 
        }  
 
        elseif ($item instanceof consumivel) {  
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


    // EQUIPAMENTOS
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
            }

            elseif ($item instanceof armadura) {
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
 

// AÇÕES DO INVENTÁRIO

if (isset($_POST['acao']) && isset($_POST['indice'])) { 
 
    $indice = $_POST['indice']; 
 
    $itens = $jogador->getInventario(); 
 
    if (isset($itens[$indice])) { 
 
        $item = $itens[$indice]; 
 
        if ($_POST['acao'] == 'equipar') { 
            $jogador->equiparItem($item, $indice); 
        } 
 
        elseif ($_POST['acao'] == 'usar') { 
            $jogador->beberPocao($item); 
        } 
 
        $_SESSION['jogador'] = $jogador; 
    } 
}


// DESEQUIPAR

if (isset($_POST['acao']) && $_POST['acao'] == 'desequipar') {

    if (isset($_POST['slot'])) {

        $slot = $_POST['slot'];

        $jogador->desequiparItem($slot);

        $_SESSION['jogador'] = $jogador;
    }
}

?>