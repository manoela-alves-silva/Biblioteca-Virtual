<?php
require __DIR__ . '/../../src/bootstrap.php';
$auth->exigirLogin();

$numeros = [
    ['📚', 'Livros', $livros->contar()],
    ['✍️', 'Autores', $autores->contar()],
    ['📝', 'Posts', $posts->contar()],
    ['💬', 'Comentários', $comentarios->contar()],
];
$pendentes = $autores->pendentes();
$ultimos_comentarios = array_slice($comentarios->todos(), 0, 5);

$titulo = 'Painel';
$pagina = 'painel';
require RAIZ . '/views/admin/cabecalho.php';
?>

<h1>Painel</h1>

<div class="numeros">
    <?php foreach ($numeros as [$icone, $rotulo, $valor]): ?>
        <div class="numero">
            <span><?= $icone ?></span>
            <strong><?= $valor ?></strong>
            <small><?= $rotulo ?></small>
        </div>
    <?php endforeach; ?>
</div>

<div class="duas-colunas">
    <section class="caixa">
        <h2>📝 Cadastros para completar</h2>
        <?php if (!$pendentes): ?>
            <p>Todo mundo tem foto e fonte. 🎉</p>
        <?php else: ?>
            <table class="tabela">
                <?php foreach ($pendentes as $autor): ?>
                    <tr>
                        <td><?= e($autor['nome']) ?></td>
                        <td>
                            <?= !$autor['foto'] ? '<span class="etiqueta baixo">sem foto</span>' : '' ?>
                            <?= !$autor['fonte_url'] ? '<span class="etiqueta baixo">sem fonte</span>' : '' ?>
                        </td>
                        <td><a href="/admin/autor-form.php?id=<?= $autor['id'] ?>">Completar</a></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </section>

    <section class="caixa">
        <h2>💬 Últimos comentários</h2>
        <?php if (!$ultimos_comentarios): ?>
            <p>Nenhum comentário ainda.</p>
        <?php else: ?>
            <table class="tabela">
                <?php foreach ($ultimos_comentarios as $comentario): ?>
                    <tr>
                        <td><strong><?= e($comentario['nome']) ?></strong><br><small><?= e($comentario['texto']) ?></small></td>
                        <td><small><?= e($comentario['post_titulo']) ?></small></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </section>
</div>

<?php require RAIZ . '/views/admin/rodape.php'; ?>
