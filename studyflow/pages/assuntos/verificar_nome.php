<?php
require_once '../../includes/config.php';
header('Content-Type: application/json');

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['error' => 'Não autorizado']);
    exit;
}

$disciplina_id = isset($_GET['disciplina_id']) ? (int)$_GET['disciplina_id'] : 0;
$nome = isset($_GET['nome']) ? trim($_GET['nome']) : '';

if ($disciplina_id && $nome) {
    $stmt = $pdo->prepare("
        SELECT id FROM assuntos 
        WHERE disciplina_id = ? AND nome = ? AND ativo = 1
    ");
    $stmt->execute([$disciplina_id, $nome]);
    
    echo json_encode([
        'existe' => $stmt->fetch() ? true : false
    ]);
} else {
    echo json_encode(['existe' => false]);
}
?>