<?php
require __DIR__ . '/../src/bootstrap.php';

$lista = $posts->recentes();

$titulo = 'Blog';
$pagina = 'blog';
require RAIZ . '/views/layout/cabecalho.php';
?>

<section class="cabecalho-pagina">
    <h1>Blog da Estante</h1>
    <p>Dicas de leitura, curiosidades e conversas sobre quem escreve.</p>
</section>

<div class="grade-posts">
    <?php foreach ($lista as $post): ?>
        <?php require RAIZ . '/views/componentes/card-post.php'; ?>
    <?php endforeach; ?>
</div>

<?php require RAIZ . '/views/layout/rodape.php'; ?>
