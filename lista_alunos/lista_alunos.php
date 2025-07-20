<?php
$alunos = [];

for ($i = 0; $i < 10; $i++) {
    $nome = readline("Nome do aluno " . ($i + 1) . ": ");
    $nota = (float) readline("Nota de $nome: ");
    $idade = (int) readline("Idade de $nome: ");
    
    $alunos[] = [
        "nome" => $nome,
        "nota" => $nota,
        "idade" => $idade
    ];
}

echo "\n------------------------------------------\n";
echo "| Nome           | Nota    | Idade       |\n";
echo "------------------------------------------\n";

foreach ($alunos as $aluno) {
    printf("| %-14s | %-7.2f | %-11d |\n", $aluno['nome'], $aluno['nota'], $aluno['idade']);
}

echo "------------------------------------------\n";
?>
