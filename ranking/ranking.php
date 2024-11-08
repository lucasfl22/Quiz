<?php
// Verificar se a sessão já não está ativa antes de iniciá-la
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once("acesso/config.inc.php");

$query = "SELECT nome, pontuacao FROM usuarios ORDER BY pontuacao DESC";
$resultado = mysqli_query($conexao, $query);
?>

<div class="ranking-container">
    <h2>Ranking Global</h2>
    
    <table class="ranking-table">
        <thead>
            <tr>
                <th>Posição</th>
                <th>Nome</th>
                <th>Pontuação</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $posicao = 1;
            while ($rank = mysqli_fetch_assoc($resultado)): 
            ?>
            <tr class="<?php echo isset($_SESSION['usuario_nome']) && $_SESSION['usuario_nome'] === $rank['nome'] ? 'usuario-atual' : ''; ?>">
                <td><?php echo $posicao++; ?>º</td>
                <td><?php echo htmlspecialchars($rank['nome']); ?></td>
                <td><?php echo $rank['pontuacao']; ?> pts</td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    
    <a href="?pg=components/conteudo/conteudo" class="btn-voltar">Voltar</a>
</div>

<style>
.ranking-container {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
}

.ranking-table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    background-color: #fff;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

.ranking-table th,
.ranking-table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

.ranking-table th {
    background-color: #4CAF50;
    color: white;
}

.ranking-table tr:nth-child(even) {
    background-color: #f5f5f5;
}

.ranking-table tr:hover {
    background-color: #f0f0f0;
}

.usuario-atual {
    background-color: #e8f5e9 !important;
    font-weight: bold;
}

.btn-voltar {
    display: inline-block;
    padding: 10px 20px;
    background-color: #4CAF50;
    color: white;
    text-decoration: none;
    border-radius: 4px;
    transition: background-color 0.3s;
}

.btn-voltar:hover {
    background-color: #45a049;
}
</style>
