<?php
require __DIR__ . '/../src/bootstrap.php';

// 1. Busca os dados
$fotos_hero    = $autores->sorteados(4);
$destaques     = $livros->destaques(8);
$todos_autores = $autores->todos();
$ultimos_posts = $posts->recentes(3);

// Sorteia uma citação entre os autores que têm uma.
$com_citacao = array_filter($todos_autores, fn($autor) => !empty($autor['citacao']));
$citacao = $com_citacao ? $com_citacao[array_rand($com_citacao)] : null;

// 2. Mostra a página
$titulo = 'Início';
$pagina = 'home';
require RAIZ . '/views/layout/cabecalho.php';
?>

<section class="hero">
    <div class="hero-texto">
        <span class="selo">✨ <?= $livros->contar() ?> livros · <?= count($todos_autores) ?> autoras e autores</span>
        <h1>Livros que <span class="destaque">mudam</span> a forma como a gente vê o mundo.</h1>
        <p>Feminismo negro, literatura brasileira, pensamento indígena e o encanto das ruas. Conheça quem escreve, leia o blog e descubra a sua próxima leitura.</p>
        <div class="botoes">
            <a href="/livros.php" class="botao">Ver livros</a>
            <a href="/autores.php" class="botao botao-claro">Conhecer quem escreve</a>
        </div>
    </div>

    <div class="hero-fotos">
        <?php foreach ($fotos_hero as $autor): ?>
            <a href="/autor.php?id=<?= e($autor['slug']) ?>" style="--cor: <?= e($autor['cor']) ?>" title="<?= e($autor['nome']) ?>">
                <?php $classe_foto = ''; require RAIZ . '/views/componentes/foto-autor.php'; ?>
            </a>
        <?php endforeach; ?>
    </div>
</section>

<section class="secao">
    <div class="secao-titulo">
        <h2>Quem escreve aqui</h2>
        <a href="/autores.php">Ver todos →</a>
    </div>

    <div class="faixa-autores">
        <?php foreach ($todos_autores as $autor): ?>
            <a href="/autor.php?id=<?= e($autor['slug']) ?>" class="bolha-autor">
                <?php $classe_foto = 'redonda'; require RAIZ . '/views/componentes/foto-autor.php'; ?>
                <span><?= e($autor['nome']) ?></span>
            </a>
        <?php endforeach; ?>
    </div>
</section>

<section class="secao">
    <div class="secao-titulo">
        <h2>Destaques da estante</h2>
        <a href="/livros.php">Ver todos →</a>
    </div>

    <div class="grade-livros">
        <?php foreach ($destaques as $livro): ?>
            <?php require RAIZ . '/views/componentes/card-livro.php'; ?>
        <?php endforeach; ?>
    </div>
</section>

<?php if ($citacao): ?>
    <section class="citacao-destaque" style="--cor: <?= e($citacao['cor']) ?>">
        <blockquote>“<?= e($citacao['citacao']) ?>”</blockquote>
        <a href="/autor.php?id=<?= e($citacao['slug']) ?>">— <?= e($citacao['nome']) ?></a>
        <?php $autor = $citacao; require RAIZ . '/views/componentes/fonte-citacao.php'; ?>
    </section>
<?php endif; ?>

<section class="secao">
    <div class="secao-titulo">
        <h2>Fresquinho no blog</h2>
        <a href="/blog.php">Ver todos →</a>
    </div>

    <div class="grade-posts">
        <?php foreach ($ultimos_posts as $post): ?>
            <?php require RAIZ . '/views/componentes/card-post.php'; ?>
        <?php endforeach; ?>
    </div>
</section>

<?php require RAIZ . '/views/layout/rodape.php'; ?>
