<?php
$arquivo = 'contatos.txt';

$nome = $fone = $email = $sobre = "";

// Ação: Abrir último contato
if (isset($_POST['abrir'])) {
    if (file_exists($arquivo)) {
        $linhas = file($arquivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $bloco = [];
        $temp = [];

        foreach ($linhas as $linha) {
            if (trim($linha) === '---') {
                if (count($temp) === 4) {
                    $bloco = $temp; // Armazena o último bloco válido
                }
                $temp = [];
            } else {
                $temp[] = $linha;
            }
        }

        // Preenche os campos com os dados do último contato salvo
        if (count($bloco) === 4) {
            $nome  = $bloco[0];
            $fone  = $bloco[1];
            $email = $bloco[2];
            $sobre = $bloco[3];
        }
    }
}

// Ação: Salvar novo contato
if (isset($_POST['salvar'])) {
    $nome  = trim($_POST['nome']);
    $fone  = trim($_POST['fone']);
    $email = trim($_POST['email']);
    $sobre = trim($_POST['sobre']);

    $conteudo = $nome . PHP_EOL . $fone . PHP_EOL . $email . PHP_EOL . $sobre . PHP_EOL . "---" . PHP_EOL;

    file_put_contents($arquivo, $conteudo, FILE_APPEND); // Append sem sobrescrever
    echo "<p style='color:green;'>✅ Contato salvo com sucesso!</p>";
}

// Ação: Limpar formulário
if (isset($_POST['limpar'])) {
    $nome = $fone = $email = $sobre = "";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Contato</title>
</head>
<body>
    <h2>Cadastro de Contato</h2>

    <form method="post" action="">
        <label>Nome:</label><br>
        <input type="text" name="nome" value="<?= htmlspecialchars($nome) ?>"><br><br>

        <label>Fone:</label><br>
        <input type="text" name="fone" value="<?= htmlspecialchars($fone) ?>"><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" value="<?= htmlspecialchars($email) ?>"><br><br>

        <label>Sobre:</label><br>
        <textarea name="sobre" rows="4" cols="40"><?= htmlspecialchars($sobre) ?></textarea><br><br>

        <input type="submit" name="salvar" value="Salvar">
        <input type="submit" name="limpar" value="Limpar">
        <input type="submit" name="abrir" value="Abrir Último">
    </form>
</body>
</html>
