<?php
require_once '../../includes/config.php';
requireLogin();

$usuario_id = $_SESSION['usuario_id'];
$disciplina_id = isset($_GET['disciplina_id']) ? (int)$_GET['disciplina_id'] : 0;

// Buscar disciplinas do usuário para o select
$stmtDisciplinas = $pdo->prepare("SELECT id, nome, cor FROM disciplinas WHERE usuario_id = ? AND ativo = 1 ORDER BY nome");
$stmtDisciplinas->execute([$usuario_id]);
$disciplinas = $stmtDisciplinas->fetchAll();

// Se uma disciplina específica foi selecionada, verificar se pertence ao usuário
if ($disciplina_id > 0) {
    $stmt = $pdo->prepare("SELECT * FROM disciplinas WHERE id = ? AND usuario_id = ?");
    $stmt->execute([$disciplina_id, $usuario_id]);
    $disciplina_selecionada = $stmt->fetch();
    
    if (!$disciplina_selecionada) {
        $_SESSION['error'] = "Disciplina não encontrada.";
        header('Location: ../disciplinas/');
        exit;
    }
}

// Buscar assuntos para assunto_pai (opcional)
$stmtPai = $pdo->prepare("
    SELECT a.id, a.nome, d.nome as disciplina_nome 
    FROM assuntos a
    JOIN disciplinas d ON a.disciplina_id = d.id
    WHERE d.usuario_id = ? AND a.ativo = 1 AND a.assunto_pai_id IS NULL
    ORDER BY d.nome, a.nome
");
$stmtPai->execute([$usuario_id]);
$assuntosPai = $stmtPai->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $disciplina_id = (int)$_POST['disciplina_id'];
    $nome = trim($_POST['nome']);
    $descricao = trim($_POST['descricao']);
    $dificuldade = $_POST['dificuldade'];
    $prioridade = $_POST['prioridade'];
    $horas_estimadas = (int)$_POST['horas_estimadas'];
    $assunto_pai_id = !empty($_POST['assunto_pai_id']) ? (int)$_POST['assunto_pai_id'] : null;
    $ordem = (int)$_POST['ordem'];
    
    $errors = [];
    
    // Validações
    if (empty($disciplina_id)) {
        $errors[] = "Selecione uma disciplina.";
    }
    
    if (empty($nome)) {
        $errors[] = "O nome do assunto é obrigatório.";
    }
    
    // Verificar se a disciplina pertence ao usuário
    $stmt = $pdo->prepare("SELECT id FROM disciplinas WHERE id = ? AND usuario_id = ?");
    $stmt->execute([$disciplina_id, $usuario_id]);
    if (!$stmt->fetch()) {
        $errors[] = "Disciplina inválida.";
    }
    
    // Verificar se já existe assunto com mesmo nome na mesma disciplina
    $stmt = $pdo->prepare("SELECT id FROM assuntos WHERE disciplina_id = ? AND nome = ? AND ativo = 1");
    $stmt->execute([$disciplina_id, $nome]);
    if ($stmt->fetch()) {
        $errors[] = "Já existe um assunto com este nome nesta disciplina.";
    }
    
    if (empty($errors)) {
        try {
            $pdo->beginTransaction();
            
            $stmt = $pdo->prepare("
                INSERT INTO assuntos (
                    disciplina_id, nome, descricao, dificuldade, prioridade, 
                    horas_estimadas, assunto_pai_id, ordem
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)
            ");
            $stmt->execute([
                $disciplina_id, $nome, $descricao, $dificuldade, $prioridade,
                $horas_estimadas, $assunto_pai_id, $ordem
            ]);
            
            $assunto_id = $pdo->lastInsertId();
            
            // Criar notificação
            $stmtNotif = $pdo->prepare("
                INSERT INTO notificacoes (usuario_id, titulo, mensagem, tipo) 
                VALUES (?, 'Novo Assunto Criado', ?, 'sistema')
            ");
            $mensagem = "O assunto '$nome' foi adicionado com sucesso!";
            $stmtNotif->execute([$usuario_id, $mensagem]);
            
            $pdo->commit();
            
            $_SESSION['success'] = "Assunto criado com sucesso!";
            header("Location: index.php?disciplina_id=$disciplina_id");
            exit;
            
        } catch (PDOException $e) {
            $pdo->rollBack();
            $errors[] = "Erro ao criar assunto: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Assunto - StudyFlow</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .container {
            max-width: 800px;
            margin: 50px auto;
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        
        h2 {
            color: #333;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 10px;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 15px;
        }
        
        h2 i {
            color: #667eea;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: 500;
        }
        
        .required::after {
            content: '*';
            color: #e74c3c;
            margin-left: 4px;
        }
        
        input[type="text"],
        input[type="number"],
        select,
        textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 15px;
            font-family: inherit;
            transition: all 0.3s;
        }
        
        input[type="text"]:focus,
        input[type="number"]:focus,
        select:focus,
        textarea:focus {
            border-color: #667eea;
            outline: none;
            box-shadow: 0 0 0 3px rgba(102,126,234,0.1);
        }
        
        textarea {
            min-height: 100px;
            resize: vertical;
        }
        
        .row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 14px 30px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(102,126,234,0.4);
        }
        
        .btn-secondary {
            background: #95a5a6;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 15px;
        }
        
        .btn-secondary:hover {
            background: #7f8c8d;
        }
        
        .alert {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        
        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .info-box {
            background: #e3f2fd;
            border-left: 4px solid #2196f3;
            padding: 15px;
            margin-bottom: 25px;
            border-radius: 5px;
        }
        
        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
            margin-left: 10px;
        }
        
        .badge-info {
            background: #3498db;
            color: white;
        }
        
        .disciplina-option {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 5px;
        }
        
        .disciplina-cor {
            width: 15px;
            height: 15px;
            border-radius: 3px;
        }
        
        .help-text {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
        }
        
        .loading {
            display: none;
            text-align: center;
            margin-top: 10px;
        }
        
        .spinner {
            border: 3px solid #f3f3f3;
            border-top: 3px solid #667eea;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            animation: spin 1s linear infinite;
            margin: 0 auto;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>
            <i class="fas fa-plus-circle"></i>
            Novo Assunto
            <?php if (isset($disciplina_selecionada)): ?>
                <span class="badge badge-info"><?php echo htmlspecialchars($disciplina_selecionada['nome']); ?></span>
            <?php endif; ?>
        </h2>
        
        <?php if (!empty($errors)): ?>
            <div class="alert alert-error">
                <ul style="margin: 0; padding-left: 20px;">
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="" id="formAssunto">
            <!-- Disciplina (campo obrigatório) -->
            <div class="form-group">
                <label class="required">Disciplina</label>
                <select name="disciplina_id" id="disciplina_id" required>
                    <option value="">Selecione uma disciplina...</option>
                    <?php foreach ($disciplinas as $disc): ?>
                        <option value="<?php echo $disc['id']; ?>" 
                                data-cor="<?php echo $disc['cor']; ?>"
                                <?php echo ($disciplina_id == $disc['id'] || (isset($_POST['disciplina_id']) && $_POST['disciplina_id'] == $disc['id'])) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($disc['nome']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <div class="help-text">
                    <i class="fas fa-info-circle"></i> Selecione a disciplina à qual este assunto pertence
                </div>
            </div>
            
            <!-- Nome do Assunto -->
            <div class="form-group">
                <label class="required">Nome do Assunto</label>
                <input type="text" name="nome" id="nome" required 
                       value="<?php echo isset($_POST['nome']) ? htmlspecialchars($_POST['nome']) : ''; ?>"
                       placeholder="Ex: Funções Trigonométricas, Orações Subordinadas, etc...">
                <div class="help-text">
                    <i class="fas fa-info-circle"></i> Escolha um nome claro e específico
                </div>
            </div>
            
            <!-- Descrição -->
            <div class="form-group">
                <label>Descrição</label>
                <textarea name="descricao" id="descricao" 
                          placeholder="Descreva o conteúdo deste assunto (opcional)"><?php echo isset($_POST['descricao']) ? htmlspecialchars($_POST['descricao']) : ''; ?></textarea>
            </div>
            
            <!-- Dificuldade e Prioridade -->
            <div class="row">
                <div class="form-group">
                    <label>Dificuldade</label>
                    <select name="dificuldade">
                        <option value="facil" <?php echo (isset($_POST['dificuldade']) && $_POST['dificuldade'] == 'facil') ? 'selected' : ''; ?>>Fácil</option>
                        <option value="medio" <?php echo (!isset($_POST['dificuldade']) || $_POST['dificuldade'] == 'medio') ? 'selected' : ''; ?>>Médio</option>
                        <option value="dificil" <?php echo (isset($_POST['dificuldade']) && $_POST['dificuldade'] == 'dificil') ? 'selected' : ''; ?>>Difícil</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Prioridade</label>
                    <select name="prioridade">
                        <option value="baixa" <?php echo (isset($_POST['prioridade']) && $_POST['prioridade'] == 'baixa') ? 'selected' : ''; ?>>Baixa</option>
                        <option value="media" <?php echo (!isset($_POST['prioridade']) || $_POST['prioridade'] == 'media') ? 'selected' : ''; ?>>Média</option>
                        <option value="alta" <?php echo (isset($_POST['prioridade']) && $_POST['prioridade'] == 'alta') ? 'selected' : ''; ?>>Alta</option>
                    </select>
                </div>
            </div>
            
            <!-- Horas Estimadas e Ordem -->
            <div class="row">
                <div class="form-group">
                    <label>Horas Estimadas</label>
                    <input type="number" name="horas_estimadas" min="0" step="1" 
                           value="<?php echo isset($_POST['horas_estimadas']) ? $_POST['horas_estimadas'] : '0'; ?>">
                </div>
                
                <div class="form-group">
                    <label>Ordem</label>
                    <input type="number" name="ordem" min="0" 
                           value="<?php echo isset($_POST['ordem']) ? $_POST['ordem'] : '0'; ?>">
                </div>
            </div>
            
            <!-- Assunto Pai (subassunto) -->
            <?php if (!empty($assuntosPai)): ?>
            <div class="form-group">
                <label>É subassunto de?</label>
                <select name="assunto_pai_id" id="assunto_pai_id">
                    <option value="">-- Não é subassunto --</option>
                    <?php foreach ($assuntosPai as $pai): ?>
                        <option value="<?php echo $pai['id']; ?>" 
                                <?php echo (isset($_POST['assunto_pai_id']) && $_POST['assunto_pai_id'] == $pai['id']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($pai['disciplina_nome'] . ' - ' . $pai['nome']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <div class="help-text">
                    <i class="fas fa-info-circle"></i> Se este assunto for um tópico dentro de outro assunto maior
                </div>
            </div>
            <?php endif; ?>
            
            <!-- Botões -->
            <div class="form-group">
                <button type="submit" class="btn-primary" id="btnSalvar">
                    <i class="fas fa-save"></i>
                    <span>Salvar Assunto</span>
                </button>
            </div>
        </form>
        
        <div class="loading" id="loading">
            <div class="spinner"></div>
            <p style="margin-top: 10px;">Criando assunto...</p>
        </div>
        
        <div style="text-align: center;">
            <a href="<?php echo $disciplina_id ? 'index.php?disciplina_id=' . $disciplina_id : '../disciplinas/'; ?>" class="btn-secondary">
                <i class="fas fa-arrow-left"></i>
                Voltar
            </a>
        </div>
    </div>
    
    <script>
        // Preview da cor da disciplina selecionada
        const disciplinaSelect = document.getElementById('disciplina_id');
        if (disciplinaSelect) {
            disciplinaSelect.addEventListener('change', function() {
                const selected = this.options[this.selectedIndex];
                if (selected && selected.dataset.cor) {
                    this.style.borderColor = selected.dataset.cor;
                }
            });
        }
        
        // Validação em tempo real
        const nomeInput = document.getElementById('nome');
        if (nomeInput) {
            nomeInput.addEventListener('input', function() {
                if (this.value.length < 3) {
                    this.style.borderColor = '#e74c3c';
                } else {
                    this.style.borderColor = '#27ae60';
                }
            });
        }
        
        // Loading no envio
        document.getElementById('formAssunto').addEventListener('submit', function(e) {
            const disciplina = document.getElementById('disciplina_id').value;
            const nome = document.getElementById('nome').value;
            
            if (!disciplina || !nome) {
                e.preventDefault();
                alert('Por favor, preencha todos os campos obrigatórios.');
                return;
            }
            
            document.querySelector('.btn-primary').style.display = 'none';
            document.getElementById('loading').style.display = 'block';
        });
        
        // Auto-completar sugestões de nome baseado na disciplina
        function sugerirNomeAssunto() {
            const disciplina = document.getElementById('disciplina_id');
            const nome = document.getElementById('nome');
            
            if (disciplina.value && !nome.value) {
                const disciplinaNome = disciplina.options[disciplina.selectedIndex].text;
                const sugestoes = [
                    'Introdução',
                    'Conceitos Básicos',
                    'Avançado',
                    'Exercícios',
                    'Revisão'
                ];
                // Não preenche automaticamente, apenas mostra sugestão em tooltip
            }
        }
        
        // Verificar se já existe assunto com mesmo nome (AJAX)
        async function verificarNomeUnico() {
            const disciplina = document.getElementById('disciplina_id').value;
            const nome = document.getElementById('nome').value;
            
            if (disciplina && nome.length > 2) {
                try {
                    const response = await fetch(`verificar_nome.php?disciplina_id=${disciplina}&nome=${encodeURIComponent(nome)}`);
                    const data = await response.json();
                    
                    if (data.existe) {
                        mostrarAlerta('Já existe um assunto com este nome nesta disciplina.');
                    }
                } catch (error) {
                    console.error('Erro ao verificar nome:', error);
                }
            }
        }
        
        // Debounce para não fazer muitas requisições
        let timeout;
        document.getElementById('nome').addEventListener('input', function() {
            clearTimeout(timeout);
            timeout = setTimeout(verificarNomeUnico, 500);
        });
    </script>
</body>
</html>