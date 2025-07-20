<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>
<body>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numero1 = floatval($_POST["numero1"]);
    $numero2 = floatval($_POST["numero2"]);

    $soma = $numero1 + $numero2;
    $subtracao = $numero1 - $numero2;
    $multiplicacao = $numero1 * $numero2;
    $divisao = $numero2 != 0 ? $numero1 / $numero2 : "Divisão por zero não é permitido.";

    echo "<h3>Resultados:</h3>";
    echo "Soma: $soma<br>";
    echo "Subtração: $subtracao<br>";
    echo "Multiplicação: $multiplicacao<br>";
    echo "Divisão: " . (is_string($divisao) ? $divisao : number_format($divisao, 2)) . "<br>";
}
?>

<form method="post">
    Primeiro número: <input type="text" name="numero1"><br>
    Segundo número: <input type="text" name="numero2"><br>
    <input type="submit" value="Calcular">
</form>
    
</body>
</html>

