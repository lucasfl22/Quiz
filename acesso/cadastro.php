<?php
require_once 'config.inc.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = trim($_POST['usuario']);
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];
    $confirmar_senha = $_POST['confirmar_senha'];
    
    // Validações
    if (strlen($nome) < 3) {
        header("Location: form_cadastro.php?erro=O nome deve ter pelo menos 3 caracteres");
        exit();
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: form_cadastro.php?erro=E-mail inválido");
        exit();
    }
    
    if (strlen($senha) < 6) {
        header("Location: form_cadastro.php?erro=A senha deve ter pelo menos 6 caracteres");
        exit();
    }
    
    if ($senha !== $confirmar_senha) {
        header("Location: form_cadastro.php?erro=As senhas não coincidem");
        exit();
    }
    
    // Verifica se nome ou email já existem
    $sql_check = "SELECT * FROM usuarios WHERE nome = ? OR email = ?";
    $stmt = mysqli_prepare($conexao, $sql_check);
    mysqli_stmt_bind_param($stmt, "ss", $nome, $email);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    
    if (mysqli_num_rows($resultado) > 0) {
        header("Location: form_cadastro.php?erro=Nome ou e-mail já cadastrado");
        exit();
    }
    
    // Insere novo usuário (senha sem criptografia)
    $sql_insert = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $sql_insert);
    mysqli_stmt_bind_param($stmt, "sss", $nome, $email, $senha);
    
    if (mysqli_stmt_execute($stmt)) {
        // Após cadastro bem sucedido, criar a sessão e redirecionar
        $_SESSION['usuario_id'] = mysqli_insert_id($conexao);
        $_SESSION['usuario_nome'] = $nome;
        header("Location: ../index.php"); // Mudado para conteudo.php
    } else {
        header("Location: form_cadastro.php?erro=Erro ao cadastrar usuário");
    }
    
    mysqli_stmt_close($stmt);
    mysqli_close($conexao);
}
