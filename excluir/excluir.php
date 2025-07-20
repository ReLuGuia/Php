<?php
require 'db.php';

$id = $_GET['id'];

if ($id) {
    $stmt = $pdo->prepare("DELETE FROM contatos WHERE id = ?");
    $stmt->execute([$id]);
}
header("Location: index.php");
