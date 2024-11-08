<?php
require_once __DIR__ . '/../../acesso/config.inc.php';
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $amigo_id = $_POST['amigo_id'];
    $usuario_id = $_SESSION['usuario_id'];

    if ($amigo_id && $usuario_id) {
        $sql = "DELETE FROM amizades WHERE (usuario_id = ? AND amigo_id = ?) OR (usuario_id = ? AND amigo_id = ?)";
        $stmt = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($stmt, "iiii", $usuario_id, $amigo_id, $amigo_id, $usuario_id);
        if (mysqli_stmt_execute($stmt)) {
            echo "Amizade removida!";
        } else {
            echo "Erro ao remover amizade.";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Dados inválidos.";
    }
    mysqli_close($conexao);
} else {
    echo "Requisição inválida.";
}
?>