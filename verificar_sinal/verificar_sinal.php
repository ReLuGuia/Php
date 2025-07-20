<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numero1 = floatval($_POST["numero1"]);
    $numero2 = floatval($_POST["numero2"]);

    $resultado1 = $numero1 > 0 ? "positivo" : ($numero1 < 0 ? "negativo" : "zero");
    $resultado2 = $numero2 > 0 ? "positivo" : ($numero1 < 0 ? "negativo" : "zero");

    echo "<h3> Resultados: </h3>";
    echo "O primeiro número ($numero1) é $resultado1. <br>";
    echo "O segundo número ($numero2) é $resultado2.<br>";
}
?>

<form method="post">
    Primeiro número: <input type="text" name="numero1"><br>
    Segundo número: <input type="text" name="numero2"><br>
    <input type="submit" value="Verificar">
</form>