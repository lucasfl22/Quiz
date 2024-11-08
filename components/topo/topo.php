<?php
session_start();
?>

<header class="header">
    <div class="glow-effect"></div>
    <div class="header-content">
        <div class="logo">Quiz Master</div>
        <nav class="nav-menu">
            <a href="index.php" class="nav-item auth-buttonn">Home</a>
            <a href="index.php?pg=ranking/ranking" class="nav-item auth-buttonn">Ranking</a>
            <a href="index.php?pg=amizade/amizade" class="nav-item auth-buttonn">Amizade</a>
            
            <?php if(isset($_SESSION['usuario_nome'])): ?>
                <a href="index.php?pg=perfil/perfil" class="nav-item profile-button">
                    <i class="fas fa-user"></i> <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?>
                </a>
                <a href="acesso/logout.php" class="nav-item auth-button logout-btn">Logout</a>
            <?php else: ?>
                <div class="auth-section">
                    <span class="welcome-text">Cadastre-se para começar!</span>
                    <div class="auth-buttons">
                        <a href="acesso/form_login.php" class="nav-item auth-button">Login</a>
                        <a href="acesso/form_cadastro.php" class="nav-item auth-button">Cadastro</a>
                    </div>
                </div>
            <?php endif; ?>
        </nav>
    </div>
</header>

<style>
.header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 20px;
}

.nav-menu {
    display: flex;
    align-items: center;
    gap: 20px;
}

.auth-section {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.welcome-text {
    color: #fff;
    margin-bottom: 5px;
    font-family: 'Rajdhani', sans-serif;
    text-align: center;
}

.auth-buttons {
    display: flex;
    gap: 10px;
}

.auth-button {
    padding: 10px 20px;
    background: linear-gradient(45deg, #6200ff, #00ff80);
    color: white;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s;
    font-family: 'Orbitron', sans-serif;
}

.auth-buttonn {
    padding: 10px 20px;
    background: linear-gradient(45deg, #6200ff, #00ff80);
    color: white;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s;
    font-family: 'Orbitron', sans-serif;
}

.auth-button:hover {
    background-color: #00cc66;
}

.logout-btn {
    background: linear-gradient(45deg, #ff3366, #ff6b6b);
}

.profile-button {
    padding: 8px 16px;
    border-radius: 20px;
    background: linear-gradient(45deg, #4C2ACD, #2CD9C0);
    color: white;
    text-decoration: none;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
}

.profile-button:hover {
    transform: translateY(-2px);
    box-shadow: 0 0 15px rgba(76, 42, 205, 0.4);
}

.profile-button i {
    font-size: 1.1em;
}
</style>

<script>
document.addEventListener('mousemove', (e) => {
    const glowEffect = document.querySelector('.glow-effect');
    const x = e.clientX;
    const y = e.clientY;
    
    glowEffect.style.left = x - 75 + 'px';
    glowEffect.style.top = y - 75 + 'px';
});
</script>

<!-- Adicione o link para o Font Awesome no head do seu HTML -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
