<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Números Ímpares</title>
</head>
<body>
    <h1>Digite um número</h1>
    <form method="post">
        <input type="number" name="numero" required>
        <button type="submit">Enviar</button>
    </form>

    <?php
    if (isset($_POST['numero'])) {
        $numero = intval($_POST['numero']);
        echo "<h2>Números ímpares até $numero:</h2>";
        for ($i = 1; $i <= $numero; $i++) {
            if ($i % 2 != 0) {
                echo $i . "<br>";
            }
        }
    }
    ?>
</body>
</html>
