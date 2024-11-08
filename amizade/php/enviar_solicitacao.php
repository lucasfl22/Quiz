<?php
require_once __DIR__ . '/../../acesso/config.inc.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $amigo_nome = $_POST['amigo_nome'];
    $usuario_id = $_SESSION['usuario_id'];

    if ($amigo_nome && $usuario_id) {
        $sql = "SELECT id FROM usuarios WHERE nome = ?";
        $stmt = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($stmt, "s", $amigo_nome);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);
        $amigo = mysqli_fetch_assoc($resultado);

        if ($amigo) {
            $amigo_id = $amigo['id'];

            $sql = "INSERT INTO amizades (usuario_id, amigo_id, status) VALUES (?, ?, 'pendente')";
            $stmt = mysqli_prepare($conexao, $sql);
            mysqli_stmt_bind_param($stmt, "ii", $usuario_id, $amigo_id);
            if (mysqli_stmt_execute($stmt)) {
                echo "Solicitação de amizade enviada!";
            } else {
                echo "Erro ao enviar solicitação.";
            }
        } else {
            echo "Usuário não encontrado.";
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Dados inválidos.";
    }
    mysqli_close($conexao);
}
?>