<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matriz Quadrada (PHP)</title>
    <style>
        body { font-family: Arial, sans-serif; display: flex; flex-direction: column; align-items: center; justify-content: center; min-height: 100vh; background-color: #f4f4f4; margin: 0; }
        .container { background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); text-align: center; }
        input[type="number"] { padding: 8px; margin-right: 10px; border: 1px solid #ccc; border-radius: 4px; }
        button { padding: 10px 15px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; }
        button:hover { background-color: #0056b3; }
        .matrix-table { border-collapse: collapse; margin-top: 20px; display: inline-block; }
        .matrix-table td { width: 40px; height: 40px; border: 1px solid #ccc; display: flex; align-items: center; justify-content: center; background-color: #f9f9f9; font-weight: bold; }
        .error-message { color: red; font-weight: bold; margin-top: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Matriz Quadrada (Tamanho N x N)</h1>
        <form method="post" action="">
            <label for="matrixSize">Digite o tamanho (N):</label>
            <input type="number" id="matrixSize" name="matrixSize" min="1" value="<?php echo isset($_POST['matrixSize']) ? htmlspecialchars($_POST['matrixSize']) : '3'; ?>">
            <button type="submit">Gerar Matriz</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $size = filter_input(INPUT_POST, 'matrixSize', FILTER_VALIDATE_INT);

            if ($size === false || $size <= 0) {
                echo '<p class="error-message">Por favor, digite um número inteiro positivo.</p>';
            } else {
                echo '<table class="matrix-table">';
                for ($i = 0; $i < $size; $i++) {
                    echo '<tr>';
                    for ($j = 0; $j < $size; $j++) {
                        echo '<td>' . (($i * $size) + $j + 1) . '</td>';
                    }
                    echo '</tr>';
                }
                echo '</table>';
            }
        }
        ?>
    </div>
</body>
</html>