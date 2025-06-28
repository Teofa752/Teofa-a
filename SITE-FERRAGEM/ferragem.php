<?php
// comentarios.php

header('Content-Type: application/json');

// Configuração do banco de dados
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'mercearia';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Erro na conexão.']));
}

$acao = $_POST['acao'] ?? '';

if ($acao == 'listar') {
    $res = $conn->query("SELECT * FROM comentarios ORDER BY id DESC");
    $comentarios = [];
    while ($row = $res->fetch_assoc()) {
        $comentarios[] = $row;
    }
    echo json_encode(['success' => true, 'comentarios' => $comentarios]);
}
elseif ($acao == 'adicionar') {
    $texto = $conn->real_escape_string($_POST['texto'] ?? '');
    if (strlen($texto) < 3) {
        echo json_encode(['success' => false, 'message' => 'Comentário muito curto.']);
        exit;
    }
    $conn->query("INSERT INTO comentarios (texto, likes) VALUES ('$texto', 0)");
    echo json_encode(['success' => true]);
}
elseif ($acao == 'like') {
    $id = (int)($_POST['id'] ?? 0);
    $conn->query("UPDATE comentarios SET likes = likes + 1 WHERE id = $id");
    echo json_encode(['success' => true]);
}

$conn->close();
