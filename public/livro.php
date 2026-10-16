<?php
require __DIR__ . '/../src/bootstrap.php';

// livro.php?id=3  -> (int) garante que é um número
$livro = $livros->porId((int) ($_GET['id'] ?? 0));

if (!$livro) {
    pagina_nao_encontrada();
}

$autor = $autores->porId($livro['autor_id']);
$relacionados = $livros->relacionados($livro);
$eh_favorito = $favoritos->contem($livro['id']);

$titulo = $livro['titulo'];
$pagina = 'livros';
require RAIZ . '/views/layout/cabecalho.php';
?>

<a href="/livros.php" class="voltar">← Voltar para a estante</a>

<section class="detalhe-livro">
    <?php $classe_capa = 'capa-grande'; require RAIZ . '/views/componentes/capa.php'; ?>

    <div class="detalhe-info">
        <h1><?= e($livro['titulo']) ?></h1>
        <p class="nome-autora">
            de <a href="/autor.php?id=<?= e($livro['autor_slug']) ?>"><?= e($livro['autor_nome']) ?></a>
            <?php if ($livro['coautoria']): ?>
                <?= e($livro['coautoria']) ?>
            <?php endif; ?>
            <?php if ($livro['ano']): ?>
                · publicado em <?= $livro['ano'] ?>
            <?php endif; ?>
        </p>

        <p class="sinopse"><?= e($livro['sinopse']) ?></p>

        <div class="caixa-compra">
            <form method="post" action="/favoritos.php">
                <?= csrf_campo() ?>
                <input type="hidden" name="id" value="<?= $livro['id'] ?>">
                <input type="hidden" name="voltar" value="<?= e($_SERVER['REQUEST_URI']) ?>">
                <button type="submit" class="botao">
                    <?= $eh_favorito ? '❤️ Está nos favoritos' : '🤍 Guardar nos favoritos' ?>
                </button>
            </form>
            <p class="pequeno-texto">
                Quer ler? Procure numa biblioteca pública ou na livraria de sua preferência.
                Este site não vende livros.
            </p>
        </div>

        <a href="/autor.php?id=<?= e($autor['slug']) ?>" class="mini-autora">
            <?php $classe_foto = 'redonda'; require RAIZ . '/views/componentes/foto-autor.php'; ?>
            <span>Sobre <strong><?= e($autor['nome']) ?></strong>: <?= e($autor['resumo']) ?></span>
        </a>
    </div>
</section>

<?php if ($relacionados): ?>
    <section class="secao">
        <div class="secao-titulo">
            <h2>Mais de <?= e($livro['autor_nome']) ?></h2>
        </div>
        <div class="grade-livros">
            <?php foreach ($relacionados as $livro): ?>
                <?php require RAIZ . '/views/componentes/card-livro.php'; ?>
            <?php endforeach; ?>
        </div>
    </section>
<?php endif; ?>

<?php require RAIZ . '/views/layout/rodape.php'; ?>
