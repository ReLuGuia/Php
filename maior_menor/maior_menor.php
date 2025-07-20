<?php

$numeros = [
    'ID1' => 45,
    'ID2' => 12,
    'ID3' => 89,
    'ID4' => 7,
    'ID5' => 62
];


if (!empty($numeros)) {
    
    $maiorValor = reset($numeros);
    $maiorID = key($numeros);

    $menorValor = reset($numeros);
    $menorID = key($numeros);

    
    foreach ($numeros as $id => $valor) {
        if ($valor > $maiorValor) {
            $maiorValor = $valor;
            $maiorID = $id;
        }
        if ($valor < $menorValor) {
            $menorValor = $valor;
            $menorID = $id;
        }
    }

    
    echo "Maior número: $maiorValor (ID: $maiorID)<br>";
    echo "Menor número: $menorValor (ID: $menorID)<br>";
} else {
    echo "Nenhum número fornecido.";
}
?>
