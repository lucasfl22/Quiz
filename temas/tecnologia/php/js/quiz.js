document.addEventListener('DOMContentLoaded', function() {
    const perguntas = document.querySelectorAll('.pergunta');
    const btnAnterior = document.getElementById('btn-anterior');
    const btnProxima = document.getElementById('btn-proxima');
    const btnFinalizar = document.getElementById('btn-finalizar');
    const perguntaAtual = document.getElementById('pergunta-atual');
    let perguntaAtiva = 0;

    function mostrarPergunta(index) {
        perguntas.forEach(p => p.classList.remove('ativa'));
        perguntas[index].classList.add('ativa');
        perguntaAtual.textContent = index + 1;

        // Atualiza a barra de progresso
        const progresso = ((index + 1) / perguntas.length) * 100;
        document.querySelector('.progresso-preenchimento').style.width = progresso + '%';

        // Atualiza botões de navegação
        btnAnterior.style.display = index === 0 ? 'none' : 'inline';
        btnProxima.style.display = index === perguntas.length - 1 ? 'none' : 'inline';
        btnFinalizar.style.display = index === perguntas.length - 1 ? 'inline' : 'none';
    }

    btnProxima.addEventListener('click', function() {
        const inputsAtuais = perguntas[perguntaAtiva].querySelectorAll('input[type="radio"]');
        let respondida = false;
        inputsAtuais.forEach(input => {
            if (input.checked) respondida = true;
        });

        if (!respondida) {
            alert('Por favor, selecione uma resposta antes de continuar.');
            return;
        }

        if (perguntaAtiva < perguntas.length - 1) {
            perguntaAtiva++;
            mostrarPergunta(perguntaAtiva);
        }
    });

    btnAnterior.addEventListener('click', function() {
        if (perguntaAtiva > 0) {
            perguntaAtiva--;
            mostrarPergunta(perguntaAtiva);
        }
    });

    // Inicializa mostrando a primeira pergunta
    mostrarPergunta(0);
}); 