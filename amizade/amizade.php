<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../acesso/form_login.php?erro=Por favor, faça login para acessar a área de amizade");
    exit();
}
?>

<div class="amizade-container">
    <h1 class="amizade-title">Área de Amizade</h1>
    
    <div class="amigos-section">
        <h2>Seus Amigos</h2>
        <ul id="amigos-list" class="amigos-list">
            <!-- Lista de amigos será preenchida via JavaScript -->
        </ul>
    </div>

    <div class="solicitacao-section">
        <h2>Enviar Solicitação de Amizade</h2>
        <input type="text" id="amigo-nome" placeholder="Digite o nome do amigo">
        <button id="enviar-solicitacao">Enviar Solicitação</button>
    </div>

    <div class="solicitacoes-section">
        <h2>Solicitações de Amizade</h2>
        <button class="toggle-solicitacoes">Ver Solicitações</button>
        <ul id="solicitacoes-list" class="solicitacoes-list">
            <!-- Lista de solicitações será preenchida via JavaScript -->
        </ul>
    </div>
</div>

<script src="js/amizade.js"></script>