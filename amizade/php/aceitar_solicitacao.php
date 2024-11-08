<?php
require_once __DIR__ . '/../../acesso/config.inc.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $solicitacao_id = $_POST['solicitacao_id'];

    $sql = "UPDATE amizades SET status = 'aceito' WHERE id = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "i", $solicitacao_id);
    if (mysqli_stmt_execute($stmt)) {
        echo "Solicitação de amizade aceita!";
    } else {
        echo "Erro ao aceitar solicitação.";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conexao);
}
?> 