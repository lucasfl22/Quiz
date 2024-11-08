<?php
require_once __DIR__ . '/../acesso/config.inc.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<div class="profile-container">
    <h2 class="profile-title">Perfil de <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?></h2>
    <div class="profile-content">
        <p>ID do usuário: <?php echo htmlspecialchars($_SESSION['usuario_id']); ?></p>
        <p>Nome de usuário: <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?></p>
        <p>Pontuação: <?php echo htmlspecialchars($_SESSION['pontuacao']); ?></p>
    </div>

<style>
.profile-container {
    max-width: 800px;
    margin: 2rem auto;
    padding: 2rem;
    background: linear-gradient(135deg, #2c2c54, #3b3b98);
    border-radius: 20px;
    box-shadow: 
        0 0 20px rgba(98, 0, 255, 0.3),
        0 0 40px rgba(0, 255, 128, 0.2);
}

.profile-title {
    font-size: 2.5rem;
    color: #fff;
    margin-bottom: 2rem;
    text-align: center;
    font-family: 'Orbitron', sans-serif;
    background: linear-gradient(90deg, #6200ff, #00ff80);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.profile-content {
    color: #fff;
    font-family: 'Rajdhani', sans-serif;
    font-size: 1.2rem;
    line-height: 1.6;
    background: rgba(255, 255, 255, 0.1);
    padding: 1rem;
    border-radius: 10px;
}
</style> 