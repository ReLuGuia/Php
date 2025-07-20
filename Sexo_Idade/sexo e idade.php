<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro e Consulta de Alunos (PHP)</title>
    <style>
        body { font-family: Arial, sans-serif; display: flex; flex-direction: column; align-items: center; justify-content: flex-start; min-height: 100vh; background-color: #f4f4f4; margin: 0; padding-top: 20px; }
        .container { background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); text-align: center; width: 80%; max-width: 900px; margin-bottom: 20px; }
        .aluno-fieldset { border: 1px solid #ccc; padding: 15px; margin-bottom: 15px; border-radius: 5px; text-align: left; }
        .aluno-fieldset legend { font-weight: bold; color: #333; }
        label { display: inline-block; width: 70px; margin-bottom: 5px; }
        input[type="text"], input[type="number"], select { padding: 8px; border: 1px solid #ccc; border-radius: 4px; width: calc(100% - 80px); margin-bottom: 10px; }
        button { padding: 10px 20px; background-color: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; margin-top: 10px; }
        button.search-button { background-color: #007bff; margin-left: 10px; }
        button.search-button:hover { background-color: #0056b3; }
        button:hover { background-color: #218838; }
        .aluno-table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .aluno-table th, .aluno-table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .aluno-table th { background-color: #f2f2f2; }
        .error-message { color: red; font-weight: bold; margin-top: 20px; }
        .search-section { margin-top: 30px; padding-top: 20px; border-top: 1px solid #eee; }
        .aluno-info { margin-top: 20px; padding: 15px; border: 1px solid #007bff; background-color: #e6f2ff; border-radius: 5px; text-align: left; }
        .aluno-info strong { color: #0056b3; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Cadastro e Consulta de Alunos</h1>

        <?php
        session_start(); // Inicia a sessão para armazenar os dados dos alunos

        // --- Processa o envio do formulário de cadastro ---
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'cadastro') {
            $alunos = [];
            $all_fields_filled = true;

            for ($i = 1; $i <= 10; $i++) {
                if (isset($_POST['aluno'][$i]['nome']) && isset($_POST['aluno'][$i]['sexo']) && isset($_POST['aluno'][$i]['idade']) &&
                    !empty(trim($_POST['aluno'][$i]['nome'])) && !empty(trim($_POST['aluno'][$i]['sexo'])) && !empty(trim($_POST['aluno'][$i]['idade']))
                ) {
                    $alunos[$i] = [
                        'nome' => htmlspecialchars(trim($_POST['aluno'][$i]['nome'])),
                        'sexo' => htmlspecialchars(trim($_POST['aluno'][$i]['sexo'])),
                        'idade' => intval($_POST['aluno'][$i]['idade'])
                    ];
                } else {
                    $all_fields_filled = false;
                    break;
                }
            }

            if ($all_fields_filled && count($alunos) === 10) {
                $_SESSION['alunos'] = $alunos; // Armazena os alunos na sessão
                echo '<p style="color: green; font-weight: bold;">Alunos cadastrados com sucesso!</p>';
            } else {
                echo '<p class="error-message">Por favor, preencha as informações de todos os 10 alunos.</p>';
            }
        }

        // --- Exibe o formulário de cadastro ---
        echo '<h2>Cadastrar Alunos</h2>';
        echo '<form method="post" action="">';
        echo '<input type="hidden" name="action" value="cadastro">'; // Campo oculto para identificar a ação
        for ($i = 1; $i <= 10; $i++):
            $nome = isset($_SESSION['alunos'][$i]['nome']) ? $_SESSION['alunos'][$i]['nome'] : '';
            $sexo = isset($_SESSION['alunos'][$i]['sexo']) ? $_SESSION['alunos'][$i]['sexo'] : '';
            $idade = isset($_SESSION['alunos'][$i]['idade']) ? $_SESSION['alunos'][$i]['idade'] : '';
        ?>
            <fieldset class="aluno-fieldset">
                <legend>Aluno <?= $i ?></legend>
                <label for="nome_<?= $i ?>">Nome:</label>
                <input type="text" id="nome_<?= $i ?>" name="aluno[<?= $i ?>][nome]" value="<?= $nome ?>" required><br>
                <label for="sexo_<?= $i ?>">Sexo:</label>
                <select id="sexo_<?= $i ?>" name="aluno[<?= $i ?>][sexo]" required>
                    <option value="">Selecione</option>
                    <option value="M" <?= ($sexo === 'M') ? 'selected' : '' ?>>Masculino</option>
                    <option value="F" <?= ($sexo === 'F') ? 'selected' : '' ?>>Feminino</option>
                    <option value="O" <?= ($sexo === 'O') ? 'selected' : '' ?>>Outro</option>
                </select><br>
                <label for="idade_<?= $i ?>">Idade:</label>
                <input type="number" id="idade_<?= $i ?>" name="aluno[<?= $i ?>][idade]" min="0" max="120" value="<?= $idade ?>" required><br>
            </fieldset>
        <?php endfor; ?>
        <button type="submit">Cadastrar Alunos</button>
        </form>

        <?php
        // --- Exibe a tabela de alunos e o formulário de busca se houver alunos na sessão ---
        if (isset($_SESSION['alunos']) && !empty($_SESSION['alunos'])) {
            $alunos = $_SESSION['alunos']; // Pega os alunos da sessão

            echo '<div class="search-section">';
            echo '<h2>Alunos Cadastrados (Matriz)</h2>';
            echo '<table class="aluno-table">';
            echo '<thead><tr><th>Índice</th><th>Nome</th><th>Sexo</th><th>Idade</th></tr></thead>';
            echo '<tbody>';
            foreach ($alunos as $index => $aluno) {
                echo '<tr>';
                echo '<td>' . $index . '</td>';
                echo '<td>' . $aluno['nome'] . '</td>';
                echo '<td>' . $aluno['sexo'] . '</td>';
                echo '<td>' . $aluno['idade'] . '</td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';

            echo '<h2>Buscar Aluno por Índice</h2>';
            echo '<form method="get" action="">';
            echo '<label for="indiceAluno">Índice (1-10):</label>';
            echo '<input type="number" id="indiceAluno" name="indice" min="1" max="10" value="' . (isset($_GET['indice']) ? htmlspecialchars($_GET['indice']) : '') . '">';
            echo '<button type="submit" class="search-button">Buscar</button>';
            echo '</form>';

            // Exibe informação do aluno correspondente
            if (isset($_GET['indice'])) {
                $indiceBusca = filter_input(INPUT_GET, 'indice', FILTER_VALIDATE_INT);
                if ($indiceBusca !== false && $indiceBusca >= 1 && $indiceBusca <= 10 && isset($alunos[$indiceBusca])) {
                    $alunoEncontrado = $alunos[$indiceBusca];
                    echo '<div class="aluno-info">';
                    echo '<h3>Informação do Aluno Índice ' . $indiceBusca . ':</h3>';
                    echo '<p><strong>Nome:</strong> ' . $alunoEncontrado['nome'] . '</p>';
                    echo '<p><strong>Sexo:</strong> ' . $alunoEncontrado['sexo'] . '</p>';
                    echo '<p><strong>Idade:</strong> ' . $alunoEncontrado['idade'] . '</p>';
                    echo '</div>';
                } else {
                    echo '<p class="error-message">Índice de aluno inválido ou não encontrado.</p>';
                }
            }
            echo '</div>'; // Fecha search-section
        } else {
            echo '<p class="error-message">Nenhum aluno cadastrado ainda. Por favor, preencha o formulário acima.</p>';
        }
        ?>
    </div>
</body>
</html>