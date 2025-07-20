<?php
require 'db.php';

$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];

if (!empty($nome) && !empty($email) && !empty($telefone)) {
    $stmt = $pdo->prepare("INSERT INTO contatos (nome, email, telefone) VALUES (?, ?, ?)");
    $stmt->execute([$nome, $email, $telefone]);
}
header("Location: index.php");
