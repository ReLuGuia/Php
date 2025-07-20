<!DOCTYPE html>
<html>
<head>
    <title>Menu de Descontos</title>
</head>
<body>
    <h1>Menu de Descontos</h1>
    <form method="post">
        <label>Escolha uma opção:</label><br>
        <input type="radio" name="opcao" value="1" required> 1 - Desconto de 10%<br>
        <input type="radio" name="opcao" value="2"> 2 - Desconto de 20%<br>
        <input type="radio" name="opcao" value="3"> 3 - Desconto de 5%<br>
        <input type="radio" name="opcao" value="4"> 4 - Sair<br><br>

        <label>Digite o valor:</label><br>
        <input type="number" step="0.01" name="valor" required><br><br>

        <input type="submit" value="Calcular">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $opcao = $_POST["opcao"];
        $valor = floatval($_POST["valor"]);

        switch ($opcao) {
            case 1:
                $total = $valor * 0.90;
                echo "<p>Total com 10% de desconto: R$ " . number_format($total, 2, ',', '.') . "</p>";
                break;

            case 2:
                $total = $valor * 0.80;
                echo "<p>Total com 20% de desconto: R$ " . number_format($total, 2, ',', '.') . "</p>";
                break;

            case 3:
                $total = $valor * 0.95;
                echo "<p>Total com 5% de desconto: R$ " . number_format($total, 2, ',', '.') . "</p>";
                break;

            case 4:
                echo "<p>Saindo do sistema... Atualize a página para reiniciar.</p>";
                break;

            default:
                echo "<p>Opção inválida.</p>";
                break;
        }
    }
    ?>
</body>
</html>
