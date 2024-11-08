<?php
require_once __DIR__ . '/../../acesso/config.inc.php';
session_start();

$usuario_id = $_SESSION['usuario_id'];

$sql = "SELECT u.id, u.nome FROM usuarios u
        JOIN amizades a ON (u.id = a.amigo_id OR u.id = a.usuario_id)
        WHERE (a.usuario_id = ? OR a.amigo_id = ?) AND a.status = 'aceito' AND u.id != ?";
$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, "iii", $usuario_id, $usuario_id, $usuario_id);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);

$amigos = [];
while ($amigo = mysqli_fetch_assoc($resultado)) {
    $amigos[] = $amigo;
}

echo json_encode($amigos);

mysqli_stmt_close($stmt);
mysqli_close($conexao);
?> 