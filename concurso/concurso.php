<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Nota de Corte - Concurso</title>
</head>
<body>
    <h2>Nota de Corte do Concurso</h2>
    <form method="post">
        <label for="notas">Notas dos candidatos (separadas por espaço):</label><br>
        <input type="text" name="notas" required><br><br>

        <label for="k">Número mínimo de aprovados (K):</label><br>
        <input type="number" name="k" min="1" required><br><br>

        <input type="submit" value="Calcular Nota de Corte">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $notas_str = $_POST["notas"];
        $k = intval($_POST["k"]);

        
        $notas = array_map('intval', explode(' ', trim($notas_str)));

        $n = count($notas);

        if ($k < 1 || $k > $n) {
            echo "<p style='color:red;'>Erro: K deve estar entre 1 e o número de candidatos ($n).</p>";
        } else {
            
            rsort($notas);

            
            $nota_corte = $notas[$k - 1];

            echo "<h3>Nota de corte: $nota_corte</h3>";
        }
    }
    ?>
</body>
</html>
