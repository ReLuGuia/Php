
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Verificador de Placas</title>
</head>
<body>
    <h2>Verificador de Placas de Carro</h2>
    <form method="post">
        <label for="placa">Digite a placa:</label><br>
        <input type="text" name="placa" maxlength="10" required><br><br>
        <input type="submit" value="Verificar">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $placa = strtoupper(trim($_POST["placa"]));

        
        $padrao_antigo = '/^[A-Z]{3}-[0-9]{4}$/';
        $padrao_mercosul = '/^[A-Z]{3}[0-9][A-Z][0-9]{2}$/';

        if (preg_match($padrao_antigo, $placa)) {
            echo "<h3>1 (Padrão Antigo Brasileiro)</h3>";
        } elseif (preg_match($padrao_mercosul, $placa)) {
            echo "<h3>2 (Padrão Mercosul)</h3>";
        } else {
            echo "<h3>0 (Placa Falsificada)</h3>";
        }
    }
    ?>
</body>
</html>
