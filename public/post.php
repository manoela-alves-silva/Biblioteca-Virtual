<?php
require __DIR__ . '/../src/bootstrap.php';

$post = $posts->porSlug($_GET['id'] ?? '');

if (!$post) {
    pagina_nao_encontrada();
}

// ---------------------------------------------------------------------
// Envio de comentário (formulário no fim da página)
// ---------------------------------------------------------------------
$erros = [];
$nome = '';
$texto = '';

if (eh_post()) {
    verificar_csrf();

    $nome = trim($_POST['nome'] ?? '');
    $texto = trim($_POST['texto'] ?? '');

    if ($nome == '' || mb_strlen($nome) > 60) {
        $erros[] = 'Diga seu nome (até 60 letras).';
    }
    if (mb_strlen($texto) < 3 || mb_strlen($texto) > 1000) {
        $erros[] = 'O comentário precisa ter entre 3 e 1000 caracteres.';
    }

    if (!$erros) {
        $comentarios->criar($post['id'], $nome, $texto);
        flash('sucesso', 'Comentário publicado! Obrigada por participar 💛');
        redirecionar('/post.php?id=' . urlencode($post['slug']) . '#comentarios');
    }
}

$autor = $post['autor_id'] ? $autores->porId($post['autor_id']) : null;
$livros_citados = $autor ? $livros->doAutor($autor['id']) : [];
$lista_comentarios = $comentarios->doPost($post['id']);

$titulo = $post['titulo'];
$pagina = 'blog';
require RAIZ . '/views/layout/cabecalho.php';
?>

<a href="/blog.php" class="voltar">← Voltar para o blog</a>

<article class="post">
    <span class="post-emoji grande" style="--cor: <?= e($post['autor_cor'] ?? '#FF6B57') ?>"><?= e($post['emoji']) ?></span>
    <span class="post-data">Publicado em <?= data_br($post['publicado_em']) ?></span>
    <h1><?= e($post['titulo']) ?></h1>

    <?php foreach (paragrafos($post['conteudo']) as $paragrafo): ?>
        <p><?= e($paragrafo) ?></p>
    <?php endforeach; ?>

    <?php if ($autor): ?>
        <a href="/autor.php?id=<?= e($autor['slug']) ?>" class="mini-autora">
            <?php $classe_foto = 'redonda'; require RAIZ . '/views/componentes/foto-autor.php'; ?>
            <span>Conheça a biografia de <strong><?= e($autor['nome']) ?></strong> →</span>
        </a>
    <?php endif; ?>
</article>

<?php if ($livros_citados): ?>
    <section class="secao">
        <div class="secao-titulo">
            <h2>Livros de <?= e($autor['nome']) ?></h2>
        </div>
        <div class="grade-livros">
            <?php foreach ($livros_citados as $livro): ?>
                <?php require RAIZ . '/views/componentes/card-livro.php'; ?>
            <?php endforeach; ?>
        </div>
    </section>
<?php endif; ?>

<section class="secao comentarios" id="comentarios">
    <h2>💬 Comentários (<?= count($lista_comentarios) ?>)</h2>

    <?php foreach ($lista_comentarios as $comentario): ?>
        <div class="comentario">
            <div class="avatar-mini"><?= e(iniciais($comentario['nome'])) ?></div>
            <div>
                <strong><?= e($comentario['nome']) ?></strong>
                <span class="post-data"><?= data_br($comentario['criado_em']) ?></span>
                <p><?= nl2br(e($comentario['texto'])) ?></p>
            </div>
        </div>
    <?php endforeach; ?>

    <?php if (!$lista_comentarios): ?>
        <p class="pequeno-texto">Ninguém comentou ainda. Que tal ser a primeira pessoa?</p>
    <?php endif; ?>

    <form method="post" class="formulario" action="#comentarios">
        <?= csrf_campo() ?>
        <h3>Deixe seu comentário</h3>

        <?php if ($erros): ?>
            <ul class="erros">
                <?php foreach ($erros as $erro): ?>
                    <li><?= e($erro) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <label>Seu nome
            <input type="text" name="nome" maxlength="60" value="<?= e($nome) ?>" required>
        </label>
        <label>Comentário
            <textarea name="texto" rows="4" maxlength="1000" required><?= e($texto) ?></textarea>
        </label>
        <button type="submit" class="botao">Publicar comentário</button>
    </form>
</section>

<?php require RAIZ . '/views/layout/rodape.php'; ?>
