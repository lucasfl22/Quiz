<?php
require_once 'config.inc.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = trim($_POST['login']);
    $senha = $_POST['senha'];
    
    // Verifica se o login é por email ou nome de usuário
    $sql = "SELECT * FROM usuarios WHERE (email = ? OR nome = ?) AND senha = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $login, $login, $senha);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    
    if (mysqli_num_rows($resultado) == 1) {
        // Login bem sucedido
        $usuario = mysqli_fetch_assoc($resultado);
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];
        
        mysqli_stmt_close($stmt);
        mysqli_close($conexao);
        
        header("Location: ../index.php");
        exit();
    } else {
        // Login falhou
        mysqli_stmt_close($stmt);
        mysqli_close($conexao);
        
        header("Location: form_login.php?erro=Usuário ou senha inválidos");
        exit();
    }
}
?>
