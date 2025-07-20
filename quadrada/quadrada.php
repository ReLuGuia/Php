<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerador de Matriz Quadrada</title>
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
            display: inline-block; /* Ajuda a centralizar a tabela */
        }
        .matrix-table td {
            width: 40px; /* Tamanho padrão pra cada célula */
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
        <h1>Matriz Quadrada em PHP</h1>
        <form method="post" action="">
            <label for="matrixSize">Digite o tamanho (N) para uma matriz N x N:</label>
            <input type="number" id="matrixSize" name="matrixSize" min="1" value="<?php echo isset($_POST['matrixSize']) ? htmlspecialchars($_POST['matrixSize']) : '3'; ?>">
            <button type="submit">Gerar Matriz</button>
        </form>

        <?php
        // Verifica se o formulário foi enviado (ou seja, o botão "Gerar Matriz" foi clicado)
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Pega o valor digitado no campo 'matrixSize' e tenta converter pra um número inteiro
            $size = filter_input(INPUT_POST, 'matrixSize', FILTER_VALIDATE_INT);

            // Valida se o número é válido (é um inteiro e maior que zero)
            if ($size === false || $size <= 0) {
                echo '<p class="error-message">Ops! Por favor, digite um número inteiro positivo.</p>';
            } else {
                // Se o número for válido, começa a montar a tabela HTML da matriz
                echo '<table class="matrix-table">';
                // Loop pra criar as linhas da matriz
                for ($i = 0; $i < $size; $i++) {
                    echo '<tr>'; // Abre uma nova linha na tabela
                    // Loop pra criar as colunas de cada linha
                    for ($j = 0; $j < $size; $j++) {
                        // O valor da célula é sequencial, começando em 1
                        $cell_value = ($i * $size) + $j + 1;
                        echo '<td>' . $cell_value . '</td>'; // Adiciona a célula com seu valor
                    }
                    echo '</tr>'; // Fecha a linha
                }
                echo '</table>'; // Fecha a tabela da matriz
            }
        }
        ?>
    </div>
</body>
</html>