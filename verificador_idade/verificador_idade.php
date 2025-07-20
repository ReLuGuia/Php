<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idade = intval($_POST["idade"]);
    $resultado = $idade >= 18 ? "maior de idade" : "menor de idade";
    echo "<h3>Resultado:</h3>";
    echo "Com $idade anos, a pessoa é $resultado.";
}
?>

<form method="post">
    Digite a idade: <input type="number" name="idade"><br>
    <input type="submit" value="Verificar">
</form>
