<?php 
 
require_once "config.php"; 
 
$conn = DBConfig::getConn(); 
 
$sql = "SELECT nome, tempo_conclusao, dano 
        FROM ranking 
        ORDER BY tempo_conclusao ASC"; 
 
$stmt = $conn->prepare($sql); 
$stmt->execute(); 
 
$ranking = $stmt->fetchAll(PDO::FETCH_ASSOC); 
 
?> 
 
<!DOCTYPE html> 
 
<html lang="pt-br"> 
 
<head> 
 
    <meta charset="UTF-8"> 
 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" href="css/ranking.css">
    <title>Ranking</title> 
 
</head> 
 
<body> 
 
    <h1>Ranking</h1> 
 
    <table> 
 
        <tr> 
            <th>Posição</th> 
            <th>Nome</th> 
            <th>Tempo</th> 
            <th>Dano</th> 
        </tr> 
 
        <?php 
 
        $posicao = 1; 
 
        foreach ($ranking as $jogador) { 
 
            echo "<tr>"; 
 
            echo "<td>" . $posicao . "</td>"; 
            echo "<td>" . $jogador["nome"] . "</td>"; 
            echo "<td>" . $jogador["tempo_conclusao"] . "</td>"; 
            echo "<td>" . $jogador["dano"] . "</td>"; 
 
            echo "</tr>"; 
 
            $posicao++; 
        } 
 
        ?> 
 
    </table>

    <br>

    <form action="index.php" method="GET">
        <button type="submit">Voltar</button>
    </form>
 
</body> 
 
</html>