<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numeros = [
        floatval($_POST["numero1"]),
        floatval($_POST["numero2"]),
        floatval($_POST["numero3"])
    ];

    sort($numeros);

    echo "<h3>Números em ordem crescente:</h3>";
    echo implode(", ", $numeros);
}
?>

<form method="post">
    Número 1: <input type="text" name="numero1"><br>
    Número 2: <input type="text" name="numero2"><br>
    Número 3: <input type="text" name="numero3"><br>
    <input type="submit" value="Ordenar">
</form>
