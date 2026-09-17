<?php  


 
class artifice { 
 
    private array $itens = [ 
 
        "mao" => [ 
            "Espada", 
            "Machado", 
            "Lança", 
            "Martelo", 
            "Adaga" 
        ], 
 
        "cabeca" => [ 
            "Elmo", 
            "Capacete", 
            "Coroa", 
            "Máscara" 
        ], 
 
        "peito" => [ 
            "Peitoral", 
            "Armadura", 
            "Cota", 
            "Manto" 
        ], 
 
        "perna" => [ 
            "Calça", 
            "Grevas", 
            "Perneiras", 
            "Botas" 
        ] 
 
    ]; 
 
 
    private array $pocoes = [
        "Poção da Vida",
        "Elixir Vital",
        "Frasco da Cura",
        "Essência Vital",
        "Poção Regeneradora"
    ];


    private array $complementosPocao = [
        "Maior",
        "Suprema",
        "Divina",
        "Eterna",
        "Abissal"
    ];
 
 
    private array $modificadores = [ 
        "Sagrada", 
        "Amaldiçoada", 
        "do Caos", 
        "do Rei", 
        "do Imperador", 
        "do Destruidor", 
        "das Trevas", 
        "da Luz", 
        "dos Antigos", 
        "Matadora de Deuses" 
    ]; 
 
 
    private array $complementos = [ 
        "Eterna", 
        "Suprema", 
        "Abissal", 
        "Divina", 
        "Esquecida", 
        "Imortal", 
        "Celestial", 
        "Proibida", 
        "Ancestral", 
        "da Destruição" 
    ]; 
 
 
    private array $raridades = [ 
        "Comum" => [ 
            "chance" => 40, 
            "valor" => [1, 20] 
        ], 
 
        "Incomum" => [ 
            "chance" => 25, 
            "valor" => [21, 40] 
        ], 
 
        "Raro" => [ 
            "chance" => 15, 
            "valor" => [41, 70] 
        ], 
 
        "Épico" => [ 
            "chance" => 10, 
            "valor" => [71, 110] 
        ], 
 
        "Lendário" => [ 
            "chance" => 6, 
            "valor" => [111, 160] 
        ], 
 
        "Mítico" => [ 
            "chance" => 3, 
            "valor" => [161, 220] 
        ], 
 
        "Divino" => [ 
            "chance" => 1, 
            "valor" => [221, 300] 
        ] 
    ]; 
 
 
    function escolherRaridade() { 
 
        $numero = rand(1, 100); 
 
        $acumulado = 0; 
 
        foreach($this->raridades as $nome => $dados) { 
 
            $acumulado += $dados["chance"]; 
 
            if($numero <= $acumulado) { 
                return $nome; 
            } 
 
        } 
 
    } 
 
 
    function gerar() { 
 
        $raridade = $this->escolherRaridade(); 
 
        $valor = rand( 
            $this->raridades[$raridade]["valor"][0], 
            $this->raridades[$raridade]["valor"][1] 
        ); 



        if(rand(1, 100) <= 20) {

            $nomeBase = $this->pocoes[
                array_rand($this->pocoes)
            ];

            $complemento = $this->complementosPocao[
                array_rand($this->complementosPocao)
            ];

            $nome = $nomeBase . " " . $complemento;

            return new consumivel(
                $nome,
                $valor,
                $raridade
            );

        }


        $slots = array_keys($this->itens); 
 
        $slot = $slots[array_rand($slots)]; 
 
 
        $nomeBase = $this->itens[$slot][ 
            array_rand($this->itens[$slot]) 
        ]; 
 
 
        $modificador = $this->modificadores[ 
            array_rand($this->modificadores) 
        ]; 
 
 
        $complemento = $this->complementos[ 
            array_rand($this->complementos) 
        ]; 
 
 
        $nome = $nomeBase . " " . $modificador . " " . $complemento; 
 
 
        if($slot == "mao") { 
 
            return new Arma( 
                $nome, 
                $valor, 
                $raridade 
            ); 
 
        } 
 
 
        return new armadura( 
            $nome, 
            $slot, 
            $valor, 
            $raridade 
        ); 
 
    } 
 
} 
 
?>