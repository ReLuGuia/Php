<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matriz Quadrada</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #f4f4f4;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        input[type="number"] {
            padding: 8px;
            margin-right: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #0056b3;
        }
        .matrix-table {
            border-collapse: collapse;
            margin-top: 20px;
            display: inline-block; /* Para centralizar a tabela */
        }
        .matrix-table td {
            width: 40px; /* Tamanho fixo para as células */
            height: 40px;
            border: 1px solid #ccc;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f9f9f9;
            font-weight: bold;
        }
        .error-message {
            color: red;
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Gerador de Matriz Quadrada</h1>
        <form method="post" action="">
            <label for="matrixSize">Digite o tamanho da matriz (N para N x N):</label>
            <input type="number" id="matrixSize" name="matrixSize" min="1" value="<?php echo isset($_POST['matrixSize']) ? htmlspecialchars($_POST['matrixSize']) : '3'; ?>">
            <button type="submit">Gerar Matriz</button>
        </form>

        <?php
        // Verifica se o formulário foi enviado via POST
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Pega o valor do input 'matrixSize' e valida como um inteiro
            $size = filter_input(INPUT_POST, 'matrixSize', FILTER_VALIDATE_INT);

            // Verifica se o valor é um número inteiro válido e positivo
            if ($size === false || $size <= 0) {
                echo '<p class="error-message">Por favor, digite um número inteiro positivo para o tamanho da matriz.</p>';
            } else {
                // Inicia a criação da tabela HTML
                echo '<table class="matrix-table">';
                // Loop para as linhas da matriz
                for ($i = 0; $i < $size; $i++) {
                    echo '<tr>'; // Abre uma nova linha na tabela
                    // Loop para as colunas da matriz
                    for ($j = 0; $j < $size; $j++) {
                        // Calcula o valor da célula (sequencial, de 1 a N*N)
                        $cell_value = ($i * $size) + $j + 1;
                        echo '<td>' . $cell_value . '</td>'; // Adiciona a célula à linha
                    }
                    echo '</tr>'; // Fecha a linha
                }
                echo '</table>'; // Fecha a tabela
            }
        }
        ?>
    </div>
</body>
</html>