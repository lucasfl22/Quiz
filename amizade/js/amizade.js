document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('enviar-solicitacao').addEventListener('click', function() {
        const amigoNomeInput = document.getElementById('amigo-nome');
        const amigoNome = amigoNomeInput.value;

        if (amigoNome) {
            fetch('amizade/php/enviar_solicitacao.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `amigo_nome=${encodeURIComponent(amigoNome)}`
            })
            .then(response => response.text())
            .then(data => {
                alert(data);
                if (data.includes("enviada")) {
                    amigoNomeInput.value = ''; // Limpa o campo de entrada
                    listarSolicitacoes();
                    listarAmigos();
                }
            })
            .catch(error => {
                console.error('Erro:', error);
                alert('Erro ao enviar solicitação.');
            });
        } else {
            alert('Por favor, insira um nome de usuário válido.');
        }
    });

    function listarSolicitacoes() {
        fetch('amizade/php/listar_solicitacoes.php')
        .then(response => response.json())
        .then(data => {
            const solicitacoesSection = document.querySelector('.solicitacoes-section');
            const solicitacoesList = document.getElementById('solicitacoes-list');
            solicitacoesList.innerHTML = '';

            if (data.length > 0) {
                solicitacoesSection.style.display = 'block';
                solicitacoesSection.querySelector('h2').textContent = `Solicitações de Amizade (${data.length})`;

                data.forEach(solicitacao => {
                    const li = document.createElement('li');
                    li.textContent = `Solicitação de: ${solicitacao.nome}`;
                    const aceitarBtn = document.createElement('button');
                    aceitarBtn.textContent = 'Aceitar';
                    aceitarBtn.style.backgroundColor = '#00cc66';
                    aceitarBtn.onclick = () => aceitarSolicitacao(solicitacao.id);

                    const recusarBtn = document.createElement('button');
                    recusarBtn.textContent = 'Recusar';
                    recusarBtn.style.backgroundColor = '#ff4d4d';
                    recusarBtn.onclick = () => recusarSolicitacao(solicitacao.id);

                    li.appendChild(aceitarBtn);
                    li.appendChild(recusarBtn);
                    solicitacoesList.appendChild(li);
                });

                solicitacoesSection.onclick = () => {
                    solicitacoesList.style.display = solicitacoesList.style.display === 'none' ? 'block' : 'none';
                };
            } else {
                solicitacoesSection.style.display = 'none';
            }
        })
        .catch(error => console.error('Erro:', error));
    }

    function listarAmigos() {
        fetch('amizade/php/listar_amigos.php')
        .then(response => response.json())
        .then(data => {
            const amigosList = document.getElementById('amigos-list');
            amigosList.innerHTML = '';
            if (data.length > 0) {
                data.forEach(amigo => {
                    const li = document.createElement('li');
                    li.textContent = amigo.nome;

                    const perfilBtn = document.createElement('button');
                    perfilBtn.textContent = 'Ver Perfil';
                    perfilBtn.style.marginLeft = '10px';
                    perfilBtn.onclick = () => {
                        window.location.href = `index.php?pg=perfil/perfil_amigo&id=${amigo.id}`;
                    };

                    li.appendChild(perfilBtn);
                    amigosList.appendChild(li);
                });
            } else {
                amigosList.innerHTML = '<li>Você não tem amigos.</li>';
            }
        })
        .catch(error => console.error('Erro:', error));
    }

    function aceitarSolicitacao(id) {
        fetch('amizade/php/aceitar_solicitacao.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `solicitacao_id=${id}`
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
            listarSolicitacoes();
            listarAmigos();
        })
        .catch(error => console.error('Erro:', error));
    }

    function recusarSolicitacao(id) {
        fetch('amizade/php/recusar_solicitacao.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `solicitacao_id=${id}`
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
            listarSolicitacoes();
        })
        .catch(error => console.error('Erro:', error));
    }

    listarSolicitacoes();
    listarAmigos();
});