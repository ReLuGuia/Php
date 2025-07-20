<!DOCTYPE html>
<html>
<head>
    <title>Operações Matemáticas</title>
</head>
<body>

<h2>Digite um número:</h2>
<form method="post">
    <input type="number" name="numero" required>
    <input type="submit" value="Calcular">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numero = $_POST["numero"];
    $outroNumero = 2; 

    echo "<h3>Resultados das Operações com o número $numero e $outroNumero:</h3>";
    echo "Adição: " . ($numero + $outroNumero) . "<br>";
    echo "Subtração: " . ($numero - $outroNumero) . "<br>";
    echo "Multiplicação: " . ($numero * $outroNumero) . "<br>";

    if ($outroNumero != 0) {
        echo "Divisão: " . ($numero / $outroNumero) . "<br>";
    } else {
        echo "Divisão: Erro - Divisão por zero.<br>";
    }
}
?>

</body>
</html>
