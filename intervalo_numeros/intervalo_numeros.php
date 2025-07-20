<!DOCTYPE html>
<html>
<head>
    <title>Intervalo entre dois números</title>
</head>
<body>
    <h2>Informe dois números:</h2>
    <form method="post">
        Número 1: <input type="number" name="num1" required><br><br>
        Número 2: <input type="number" name="num2" required><br><br>
        <input type="submit" value="Mostrar Intervalo">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $num1 = intval($_POST["num1"]);
        $num2 = intval($_POST["num2"]);

        echo "<h3>Intervalo entre $num1 e $num2:</h3>";

        if ($num1 == $num2 || abs($num1 - $num2) == 1) {
            echo "Não há números no intervalo.";
        } else {
            $start = min($num1, $num2) + 1;
            $end = max($num1, $num2) - 1;

            for ($i = $start; $i <= $end; $i++) {
                echo $i . " ";
            }
        }
    }
    ?>
</body>
</html>

