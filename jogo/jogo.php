<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Jogo da Vida</title>
</head>
<body>
    <h2>Jogo da Vida de Conway</h2>
    <form method="post">
        <label for="n">Tamanho da matriz (N x N):</label><br>
        <input type="number" name="n" min="1" max="50" required><br><br>

        <label for="q">Número de passos (Q):</label><br>
        <input type="number" name="q" min="1" max="100" required><br><br>

        <label for="matriz">Estado inicial (uma linha por linha da matriz, usando 0 e 1):</label><br>
        <textarea name="matriz" rows="10" cols="30" required></textarea><br><br>

        <input type="submit" value="Simular">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $N = intval($_POST["n"]);
        $Q = intval($_POST["q"]);
        $entrada = trim($_POST["matriz"]);

        $linhas = explode("\n", $entrada);
        $matriz = [];

        foreach ($linhas as $linha) {
            $linha = trim($linha);
            if (strlen($linha) != $N) {
                echo "<p style='color:red;'>Erro: Cada linha da matriz deve ter exatamente $N caracteres.</p>";
                exit;
            }
            $matriz[] = str_split($linha);
        }

        if (count($matriz) != $N) {
            echo "<p style='color:red;'>Erro: Você deve fornecer exatamente $N linhas na matriz.</p>";
            exit;
        }

        function contarVizinhos($matriz, $i, $j, $N) {
            $cont = 0;
            for ($di = -1; $di <= 1; $di++) {
                for ($dj = -1; $dj <= 1; $dj++) {
                    if ($di == 0 && $dj == 0) continue;
                    $ni = $i + $di;
                    $nj = $j + $dj;
                    if ($ni >= 0 && $ni < $N && $nj >= 0 && $nj < $N) {
                        $cont += ($matriz[$ni][$nj] == '1') ? 1 : 0;
                    }
                }
            }
            return $cont;
        }

        for ($passo = 0; $passo < $Q; $passo++) {
            $nova = [];
            for ($i = 0; $i < $N; $i++) {
                for ($j = 0; $j < $N; $j++) {
                    $vivos = contarVizinhos($matriz, $i, $j, $N);
                    $celula = $matriz[$i][$j];
                    if ($celula == '1') {
                        $nova[$i][$j] = ($vivos == 2 || $vivos == 3) ? '1' : '0';
                    } else {
                        $nova[$i][$j] = ($vivos == 3) ? '1' : '0';
                    }
                }
            }
            $matriz = $nova;
        }

        echo "<h3>Resultado após $Q passo(s):</h3><pre>";
        foreach ($matriz as $linha) {
            echo implode('', $linha) . "\n";
        }
        echo "</pre>";
    }
    ?>
</body>
</html>
