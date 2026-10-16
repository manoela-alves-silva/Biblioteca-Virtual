<?php
require __DIR__ . '/../src/bootstrap.php';

// autor.php?id=luiz-antonio-simas
$autor = $autores->porSlug($_GET['id'] ?? '');

if (!$autor) {
    pagina_nao_encontrada();
}

$livros_do_autor = $livros->doAutor($autor['id']);
$posts_do_autor = $posts->doAutor($autor['id']);

$titulo = $autor['nome'];
$pagina = 'autores';
require RAIZ . '/views/layout/cabecalho.php';
?>

<a href="/autores.php" class="voltar">← Todas as autoras e autores</a>

<article class="perfil" style="--cor: <?= e($autor['cor']) ?>">
    <figure class="perfil-foto">
        <?php $classe_foto = 'retrato'; require RAIZ . '/views/componentes/foto-autor.php'; ?>
        <?php if ($autor['foto_credito']): ?>
            <figcaption>Foto: <?= e($autor['foto_credito']) ?></figcaption>
        <?php endif; ?>
    </figure>

    <div class="perfil-texto">
        <span class="selo">
            <?= e($autor['nacionalidade']) ?>
            <?php if (periodo_de_vida($autor)): ?>
                · <?= periodo_de_vida($autor) ?>
            <?php endif; ?>
        </span>
        <h1><?= e($autor['nome']) ?></h1>

        <ul class="fatos">
            <?php if ($autor['nome_completo'] && $autor['nome_completo'] != $autor['nome']): ?>
                <li><strong>Nome completo:</strong> <?= e($autor['nome_completo']) ?></li>
            <?php endif; ?>
            <?php if ($autor['local_nascimento']): ?>
                <li><strong>Nasceu em:</strong> <?= e($autor['local_nascimento']) ?></li>
            <?php endif; ?>
            <li><strong>Livros na estante:</strong> <?= count($livros_do_autor) ?></li>
        </ul>

        <?php foreach (paragrafos($autor['biografia']) as $paragrafo): ?>
            <p><?= e($paragrafo) ?></p>
        <?php endforeach; ?>

        <?php if ($autor['citacao']): ?>
            <blockquote>
                “<?= e($autor['citacao']) ?>”
                <?php require RAIZ . '/views/componentes/fonte-citacao.php'; ?>
            </blockquote>
        <?php endif; ?>

        <?php if ($autor['fonte_url']): ?>
            <p class="fonte">
                📎 Fonte das informações:
                <a href="<?= e($autor['fonte_url']) ?>" target="_blank" rel="noopener"><?= e(dominio($autor['fonte_url'])) ?> ↗</a>
            </p>
        <?php endif; ?>
    </div>
</article>

<?php if ($livros_do_autor): ?>
    <section class="secao">
        <div class="secao-titulo">
            <h2>Livros de <?= e($autor['nome']) ?></h2>
        </div>
        <div class="grade-livros">
            <?php foreach ($livros_do_autor as $livro): ?>
                <?php require RAIZ . '/views/componentes/card-livro.php'; ?>
            <?php endforeach; ?>
        </div>
    </section>
<?php endif; ?>

<?php if ($posts_do_autor): ?>
    <section class="secao">
        <div class="secao-titulo">
            <h2>No blog</h2>
        </div>
        <div class="grade-posts">
            <?php foreach ($posts_do_autor as $post): ?>
                <?php require RAIZ . '/views/componentes/card-post.php'; ?>
            <?php endforeach; ?>
        </div>
    </section>
<?php endif; ?>

<?php require RAIZ . '/views/layout/rodape.php'; ?>
