<?php
require __DIR__ . '/../../src/bootstrap.php';
$auth->exigirLogin();

if (eh_post() && ($_POST['acao'] ?? '') == 'excluir') {
    verificar_csrf();
    if ($comentarios->excluir((int) $_POST['id'])) {
        flash('sucesso', 'Comentário removido.');
    } else {
        flash('erro', 'Esse comentário não existe (talvez já tenha sido removido).');
    }
    redirecionar('/admin/comentarios.php');
}

$lista = $comentarios->todos();

$titulo = 'Comentários';
$pagina = 'comentarios';
require RAIZ . '/views/admin/cabecalho.php';
?>

<h1>Comentários (<?= count($lista) ?>)</h1>

<?php if (!$lista): ?>
    <p>Nenhum comentário ainda.</p>
<?php else: ?>
    <table class="tabela">
        <thead>
            <tr><th>Quem</th><th>Comentário</th><th>Post</th><th>Data</th><th></th></tr>
        </thead>
        <tbody>
            <?php foreach ($lista as $comentario): ?>
                <tr>
                    <td><strong><?= e($comentario['nome']) ?></strong></td>
                    <td><?= e($comentario['texto']) ?></td>
                    <td><a href="/post.php?id=<?= e($comentario['post_slug']) ?>#comentarios" target="_blank"><?= e($comentario['post_titulo']) ?></a></td>
                    <td><?= data_br($comentario['criado_em']) ?></td>
                    <td class="acoes"><?php $id_excluir = $comentario['id']; require RAIZ . '/views/admin/botao-excluir.php'; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php require RAIZ . '/views/admin/rodape.php'; ?>
