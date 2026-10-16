// =====================================================================
// tema.js - modo claro / escuro
//
// Como funciona:
// 1. Se a pessoa já escolheu um tema antes, usamos o que ficou salvo.
// 2. Se não escolheu, o CSS segue o tema do sistema (prefers-color-scheme).
// 3. O botão ☀️/🌙 troca o tema e salva a escolha no navegador.
//
// Este arquivo é carregado no <head> para aplicar o tema ANTES da página
// aparecer (assim a tela não "pisca" branca no modo escuro).
// =====================================================================

const CHAVE_TEMA = 'estante-tema';

// Lê o tema salvo. O try/catch evita erro se o navegador bloquear o armazenamento.
function temaSalvo() {
    try {
        return localStorage.getItem(CHAVE_TEMA);
    } catch (erro) {
        return null;
    }
}

// Descobre qual tema está valendo agora: o escolhido ou o do sistema.
function temaAtual() {
    const salvo = temaSalvo();
    if (salvo) {
        return salvo;
    }
    return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'escuro' : 'claro';
}

function aplicarTema(tema) {
    document.documentElement.dataset.tema = tema; // vira <html data-tema="escuro">
}

// Aplica já, antes de a página desenhar.
aplicarTema(temaAtual());

// Quando o HTML terminar de carregar, liga o botão.
document.addEventListener('DOMContentLoaded', function () {
    const botao = document.querySelector('#botao-tema');
    if (!botao) {
        return;
    }

    function atualizarBotao() {
        const escuro = temaAtual() === 'escuro';
        botao.textContent = escuro ? '☀️' : '🌙';
        botao.title = escuro ? 'Mudar para o modo claro' : 'Mudar para o modo escuro';
    }

    botao.addEventListener('click', function () {
        const novo = temaAtual() === 'escuro' ? 'claro' : 'escuro';
        aplicarTema(novo);
        try {
            localStorage.setItem(CHAVE_TEMA, novo);
        } catch (erro) {
            // Sem armazenamento: o tema muda, só não fica salvo.
        }
        atualizarBotao();
    });

    atualizarBotao();
});
