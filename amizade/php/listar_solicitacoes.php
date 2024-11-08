<?php
require_once __DIR__ . '/../../acesso/config.inc.php';
session_start();

$usuario_id = $_SESSION['usuario_id'];

$sql = "SELECT a.id, u.nome FROM amizades a
        JOIN usuarios u ON a.usuario_id = u.id
        WHERE a.amigo_id = ? AND a.status = 'pendente'";
$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, "i", $usuario_id);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);

$solicitacoes = [];
while ($solicitacao = mysqli_fetch_assoc($resultado)) {
    $solicitacoes[] = $solicitacao;
}

echo json_encode($solicitacoes);

mysqli_stmt_close($stmt);
mysqli_close($conexao);
?> 