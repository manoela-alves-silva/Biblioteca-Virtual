<?php
require __DIR__ . '/../src/bootstrap.php';

// A lista de créditos é montada a partir do banco: se você trocar uma
// foto pelo admin, ela se atualiza sozinha.
$todos = $autores->todos();

$titulo = 'Sobre o projeto';
$pagina = 'sobre';
require RAIZ . '/views/layout/cabecalho.php';
?>

<article class="post sobre">
    <span class="post-emoji grande" style="--cor: #B9A4FF">📖</span>
    <h1>Sobre a Estante Aberta</h1>

    <div class="caixa-destaque">
        <strong>Projeto pessoal de estudos, sem fins lucrativos.</strong>
        Aqui não existe loja: nenhum livro é vendido, não há pagamentos e nenhum dado é enviado para outro lugar.
    </div>

    <h2>O que é</h2>
    <p>
        A Estante Aberta é um site feito para aprender desenvolvimento web com PHP. Ele reúne biografias e livros
        de autoras e autores negros, indígenas e brasileiros que pensam o mundo a partir do feminismo negro, da
        literatura, da ancestralidade e da cultura popular.
    </p>
    <p>
        A ideia é simples: apresentar essas pessoas e as suas obras de um jeito acolhedor, como um blog de leitura,
        e despertar a vontade de ler. Para ler os livros, procure uma biblioteca pública ou a livraria de sua preferência.
    </p>

    <h2>O que eu pratiquei aqui</h2>
    <ul class="lista-bonita">
        <li>PHP com arrays, funções, <code>include</code> e orientação a objetos</li>
        <li>Banco de dados SQLite com PDO (consultas, JOIN e transações)</li>
        <li>Formulários com <code>$_GET</code> e <code>$_POST</code>, validação e sessões</li>
        <li>Login, upload de imagens e um painel de administração</li>
        <li>Segurança básica: proteção contra XSS, SQL Injection e CSRF</li>
        <li>HTML e CSS responsivos, com modo claro e escuro</li>
    </ul>

    <h2>De onde vêm as informações</h2>
    <p>
        As biografias são resumos escritos a partir de fontes públicas. Cada página de autor mostra a fonte usada,
        com link.
    </p>
    <p>
        As citações só entram no site depois de conferidas: embaixo de cada uma aparece de onde ela veio
        (livro ou palestra) e um link para você conferir. Frases muito compartilhadas na internet, mas sem
        origem comprovada, ficaram de fora.
    </p>
    <p>
        As capas dos livros são <strong>ilustrações genéricas feitas com CSS</strong> e não reproduzem as capas
        originais. Títulos, obras e nomes pertencem aos seus autores e editoras.
    </p>

    <h2>Créditos das fotos</h2>
    <table class="tabela-creditos">
        <?php foreach ($todos as $autor): ?>
            <tr>
                <td><a href="/autor.php?id=<?= e($autor['slug']) ?>"><?= e($autor['nome']) ?></a></td>
                <td>
                    <?php if (!$autor['foto']): ?>
                        <span class="pequeno-texto">Sem foto (avatar ilustrado)</span>
                    <?php elseif ($autor['foto_credito']): ?>
                        <?= e($autor['foto_credito']) ?>
                    <?php else: ?>
                        <span class="pequeno-texto">Origem não informada</span>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <p class="pequeno-texto">
        As fotos com crédito vêm do <a href="https://commons.wikimedia.org" target="_blank" rel="noopener">Wikimedia Commons</a>,
        com licenças livres (Creative Commons, GFDL ou domínio público).
    </p>
</article>

<?php require RAIZ . '/views/layout/rodape.php'; ?>
