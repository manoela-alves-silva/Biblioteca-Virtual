<?php
require __DIR__ . '/../src/bootstrap.php';

// Filtro simples: todos, só do Brasil ou só de fora.
$origem = $_GET['origem'] ?? 'todos';

$lista = array_filter($autores->todos(), function ($autor) use ($origem) {
    if ($origem == 'brasil') {
        return $autor['nacionalidade'] == 'Brasil';
    }
    if ($origem == 'mundo') {
        return $autor['nacionalidade'] != 'Brasil';
    }
    return true;
});

$abas = ['todos' => 'Todos', 'brasil' => '🇧🇷 Do Brasil', 'mundo' => '🌍 Do mundo'];

$titulo = 'Autoras & Autores';
$pagina = 'autores';
require RAIZ . '/views/layout/cabecalho.php';
?>

<section class="cabecalho-pagina">
    <h1>Autoras & Autores</h1>
    <p>Gente que escreve sobre amor, liberdade, memória, ancestralidade e a vida real.</p>
</section>

<nav class="abas">
    <?php foreach ($abas as $chave => $rotulo): ?>
        <a href="?origem=<?= $chave ?>" class="<?= $origem == $chave ? 'ativo' : '' ?>"><?= $rotulo ?></a>
    <?php endforeach; ?>
</nav>

<div class="grade-autoras">
    <?php foreach ($lista as $autor): ?>
        <a href="/autor.php?id=<?= e($autor['slug']) ?>" class="card-autora" style="--cor: <?= e($autor['cor']) ?>">
            <?php $classe_foto = 'redonda'; require RAIZ . '/views/componentes/foto-autor.php'; ?>
            <h2><?= e($autor['nome']) ?></h2>
            <span class="bandeira">
                <?= e($autor['nacionalidade']) ?>
                <?php if (periodo_de_vida($autor)): ?>
                    · <?= periodo_de_vida($autor) ?>
                <?php endif; ?>
            </span>
            <p><?= e($autor['resumo']) ?></p>
            <span class="ler-mais">Ler biografia · <?= $autor['total_livros'] ?> livro(s) →</span>
        </a>
    <?php endforeach; ?>
</div>

<?php require RAIZ . '/views/layout/rodape.php'; ?>
