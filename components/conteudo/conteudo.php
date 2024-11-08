<div class="quiz-container">
    <section class="welcome-section">
        <?php if(isset($_SESSION['usuario_nome'])): ?>
            <h1 class="welcome-title">Bem-vindo ao Quiz Master, <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?>!</h1>
        <?php else: ?>
            <h1 class="welcome-title">Bem-vindo ao Quiz Master!</h1>
        <?php endif; ?>
        <p class="welcome-subtitle">Teste seus conhecimentos em diferentes temas</p>
    </section>

    <div class="features-grid">
        <div class="feature-card">
            <div class="feature-icon">🎯</div>
            <h3 class="feature-title">Como Funciona</h3>
            <p class="feature-description">
                Escolha um tema e responda 5 perguntas desafiadoras. 
                Cada pergunta tem apenas uma resposta correta.
            </p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">🏆</div>
            <h3 class="feature-title">Sistema de Pontuação</h3>
            <p class="feature-description">
                Ganhe pontos por cada resposta correta e compare sua pontuação 
                no ranking global.
            </p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">⏱️</div>
            <h3 class="feature-title">Tempo Limitado</h3>
            <p class="feature-description">
                Você tem 30 segundos para responder cada pergunta. 
                Pense rápido!
            </p>
        </div>
    </div>

    <section class="themes-section">
        <h2 class="feature-title">Escolha seu Tema</h2>
        <h3 class="feature-description">E comece a responder quando quiser!!</h3>
        <div class="theme-buttons">
            <a href="?pg=temas/tecnologia/tecnologia" class="theme-button">Tecnologia</a>
        </div>
    </section>
</div>
