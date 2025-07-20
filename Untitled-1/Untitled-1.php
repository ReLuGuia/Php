<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jogo da Vida (PHP)</title>
    <style>
        body { font-family: Arial, sans-serif; display: flex; flex-direction: column; align-items: center; justify-content: flex-start; min-height: 100vh; background-color: #f4f4f4; margin: 0; padding-top: 20px; }
        .container { background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); text-align: center; margin-bottom: 20px; }
        input[type="number"] { padding: 8px; margin-right: 10px; border: 1px solid #ccc; border-radius: 4px; width: 60px; }
        button { padding: 10px 15px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; margin: 5px; }
        button:hover { background-color: #0056b3; }
        .game-board { display: inline-block; border: 2px solid #333; margin-top: 20px; }
        .game-row { display: flex; }
        .game-cell { width: 20px; height: 20px; border: 1px solid #eee; background-color: white; /* Célula morta */ }
        .game-cell.alive { background-color: black; /* Célula viva */ }
        .error-message { color: red; font-weight: bold; margin-top: 10px; }
        .generation-info { margin-top: 10px; font-size: 1.1em; font-weight: bold; }
        .initial-board, .final-board { margin-top: 20px; border: 1px solid #ddd; padding: 10px; background-color: #e9e9e9; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Jogo da Vida de Conway (PHP)</h1>
        <form method="post" action="">
            <label for="boardSize">Tamanho do Tabuleiro (N):</label>
            <input type="number" id="boardSize" name="boardSize" min="5" max="50" value="<?php echo isset($_POST['boardSize']) ? htmlspecialchars($_POST['boardSize']) : '10'; ?>">
            <label for="numGenerations">Número de Gerações:</label>
            <input type="number" id="numGenerations" name="numGenerations" min="1" max="100" value="<?php echo isset($_POST['numGenerations']) ? htmlspecialchars($_POST['numGenerations']) : '10'; ?>">
            <button type="submit">Simular Jogo</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $size = filter_input(INPUT_POST, 'boardSize', FILTER_VALIDATE_INT);
            $generations = filter_input(INPUT_POST, 'numGenerations', FILTER_VALIDATE_INT);

            if ($size === false || $size < 5 || $size > 50 || $generations === false || $generations < 1 || $generations > 100) {
                echo '<p class="error-message">Por favor, digite um tamanho entre 5 e 50 e um número de gerações entre 1 e 100.</p>';
            } else {
                // Função para renderizar o tabuleiro
                function renderBoard($board, $size) {
                    echo '<div class="game-board">';
                    for ($i = 0; $i < $size; $i++) {
                        echo '<div class="game-row">';
                        for ($j = 0; $j < $size; $j++) {
                            $class = ($board[$i][$j] === 1) ? 'alive' : '';
                            echo '<div class="game-cell ' . $class . '"></div>';
                        }
                        echo '</div>';
                    }
                    echo '</div>';
                }

                // Inicializa o tabuleiro com 0s e 1s aleatórios
                $board = array_fill(0, $size, array_fill(0, $size, 0));
                for ($i = 0; $i < $size; $i++) {
                    for ($j = 0; $j < $size; $j++) {
                        $board[$i][$j] = (mt_rand(0, 99) < 30) ? 1 : 0; // 30% de chance de estar viva
                    }
                }

                echo '<h2>Tabuleiro Inicial:</h2>';
                echo '<div class="initial-board">';
                renderBoard($board, $size);
                echo '</div>';

                // Simula as gerações
                for ($g = 0; $g < $generations; $g++) {
                    $newBoard = array_fill(0, $size, array_fill(0, $size, 0));

                    for ($i = 0; $i < $size; $i++) {
                        for ($j = 0; $j < $size; $j++) {
                            $liveNeighbors = 0;
                            // Conta vizinhos vivos
                            for ($ni = -1; $ni <= 1; $ni++) {
                                for ($nj = -1; $nj <= 1; $nj++) {
                                    if ($ni === 0 && $nj === 0) continue;

                                    $nRow = $i + $ni;
                                    $nCol = $j + $nj;

                                    if ($nRow >= 0 && $nRow < $size && $nCol >= 0 && $nCol < $size && $board[$nRow][$nCol] === 1) {
                                        $liveNeighbors++;
                                    }
                                }
                            }

                            // Aplica as regras do Jogo da Vida
                            if ($board[$i][$j] === 1) { // Célula viva
                                if ($liveNeighbors < 2 || $liveNeighbors > 3) {
                                    $newBoard[$i][$j] = 0; // Morre
                                } else {
                                    $newBoard[$i][$j] = 1; // Sobrevive
                                }
                            } else { // Célula morta
                                if ($liveNeighbors === 3) {
                                    $newBoard[$i][$j] = 1; // Nasce
                                } else {
                                    $newBoard[$i][$j] = 0; // Permanece morta
                                }
                            }
                        }
                    }
                    $board = $newBoard; // Atualiza o tabuleiro para a próxima geração
                }

                echo '<h2 class="generation-info">Tabuleiro Final após ' . $generations . ' gerações:</h2>';
                echo '<div class="final-board">';
                renderBoard($board, $size);
                echo '</div>';
            }
        }
        ?>
    </div>
</body>
</html>