<?php
// Verifica se a sessão já não está ativa antes de iniciá-la
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once("acesso/config.inc.php");

// Verifica se usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: /testejogo/acesso/form_login.php?erro=Por favor, faça login para acessar o quiz");
    exit();
}

// Corrigir o caminho do JSON usando __DIR__
$json = file_get_contents(__DIR__ . '/perguntas_php.json');
$data = json_decode($json, true);

// Embaralha as perguntas e pega 5 aleatórias
$perguntas = $data['perguntas'];
shuffle($perguntas);
$perguntas_selecionadas = array_slice($perguntas, 0, 5);

// Se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pontuacao = 0;
    foreach ($_POST as $key => $resposta) {
        if (strpos($key, 'pergunta_') === 0 && 
            isset($_POST['respostas_corretas'][str_replace('pergunta_', '', $key)]) && 
            $resposta === $_POST['respostas_corretas'][str_replace('pergunta_', '', $key)]) {
            $pontuacao++;
        }
    }

    // Calcula pontos (cada questão vale 10 pontos)
    $pontos_ganhos = $pontuacao * 10;

    // Atualiza a pontuação do usuário no banco de dados
    $usuario_id = $_SESSION['usuario_id'];
    $sql = "UPDATE usuarios SET pontuacao = pontuacao + ? WHERE id = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $pontos_ganhos, $usuario_id);
    mysqli_stmt_execute($stmt);

    // Busca a pontuação total atualizada
    $sql = "SELECT pontuacao FROM usuarios WHERE id = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "i", $usuario_id);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $usuario = mysqli_fetch_assoc($resultado);
    $pontuacao_total = $usuario['pontuacao'];
}
?>

<h1>Quiz PHP</h1>

<?php if (isset($pontuacao)): ?>
    <div class="resultado">
        <h2>Quiz Finalizado!</h2>
        <p>Você acertou <?php echo $pontuacao; ?> de 5 questões!</p>
        <p>Pontos ganhos: <?php echo $pontos_ganhos; ?></p>
        <p>Sua pontuação total: <?php echo $pontuacao_total; ?></p>
        <div class="botoes-resultado">
            <a href="?pg=components/conteudo/conteudo" class="btn-resultado">Página Inicial</a>
            <a href="?pg=ranking/ranking" class="btn-resultado">Ver Ranking</a>
            <a href="?pg=temas/tecnologia/tecnologia" class="btn-resultado">Tentar novamente</a>
        </div>
    </div>
<?php else: ?>
    <div class="progresso-container">
        <div>Progresso: <span id="pergunta-atual">1</span>/5</div>
        <div class="progresso-barra">
            <div class="progresso-preenchimento" style="width: 20%"></div>
        </div>
    </div>
    
    <form method="POST" id="quiz-form">
        <?php foreach ($perguntas_selecionadas as $index => $pergunta): ?>
            <div class="pergunta <?php echo $index === 0 ? 'ativa' : ''; ?>" data-pergunta="<?php echo $index; ?>">
                <h3><?php echo ($index + 1) . ". " . htmlspecialchars($pergunta['pergunta']); ?></h3>
                <?php
                    $opcoes = array_merge([$pergunta['resposta_certa']], $pergunta['respostas_erradas']);
                    shuffle($opcoes);
                ?>
                
                <?php foreach ($opcoes as $opcao): ?>
                    <div class="opcao">
                        <input type="radio" name="pergunta_<?php echo $index; ?>" 
                            value="<?php echo htmlspecialchars($opcao); ?>" required>
                        <label><?php echo htmlspecialchars($opcao); ?></label>
                    </div>
                <?php endforeach; ?>
                
                <input type="hidden" name="respostas_corretas[<?php echo $index; ?>]" 
                    value="<?php echo htmlspecialchars($pergunta['resposta_certa']); ?>">
            </div>
        <?php endforeach; ?>
        
        <div class="navegacao">
            <button type="button" id="btn-anterior" style="display: none;">Anterior</button>
            <button type="button" id="btn-proxima">Próxima</button>
            <button type="submit" id="btn-finalizar" style="display: none;">Finalizar Quiz</button>
        </div>
    </form>
<?php endif; ?>

<!-- Corrigir o caminho do JavaScript -->
<script src="temas/tecnologia/php/js/quiz.js"></script>