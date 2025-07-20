<!DOCTYPE html>
<html>
<head>
    <title>Brincadeira do Ogro</title>
</head>
<body>
    <h2>Brincadeira do Ogro e Bicho-Papão</h2>
    <form method="post">
        <label for="E">Dedos da mão esquerda (E):</label>
        <input type="number" name="E" min="0" max="5" required><br><br>

        <label for="D">Dedos da mão direita (D):</label>
        <input type="number" name="D" min="0" max="5" required><br><br>

        <input type="submit" value="Calcular Resultado">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $E = intval($_POST["E"]);
        $D = intval($_POST["D"]);

        if ($E == $D) {
            echo "<p style='color:red;'>Erro: os valores devem ser diferentes (E ≠ D).</p>";
        } elseif ($E < 0 || $E > 5 || $D < 0 || $D > 5) {
            echo "<p style='color:red;'>Erro: os valores devem estar entre 0 e 5.</p>";
        } else {
            if ($E > $D) {
                $resultado = $E + $D;
            } else {
                $resultado = 2 * ($D - $E);
            }

            echo "<h3>Resultado: $resultado</h3>";
        }
    }
    ?>
</body>
</html>
