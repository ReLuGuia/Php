<?php

$totalNotas = 0;
$quantidadeAlunos = 10;

for ($i = 1; $i <= $quantidadeAlunos; $i++) {
    while (true) {
        echo "Digite a nota do aluno $i (0 a 10): ";
        $entrada = trim(fgets(STDIN));
        $nota = floatval($entrada);

        if ($nota >= 0 && $nota <= 10) {
            $totalNotas += $nota;
            break;
        } else {
            echo "⚠️ Nota inválida! Por favor, digite um valor entre 0 e 10.\n";
        }
    }
}

$media = $totalNotas / $quantidadeAlunos;
echo "\n📊 A média das notas dos $quantidadeAlunos alunos é: " . number_format($media, 2) . "\n";

?>
