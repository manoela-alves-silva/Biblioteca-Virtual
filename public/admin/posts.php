<?php
require __DIR__ . '/../../src/bootstrap.php';
$auth->exigirLogin();

if (eh_post() && ($_POST['acao'] ?? '') == 'excluir') {
    verificar_csrf();
    if ($posts->excluir((int) $_POST['id'])) {
        flash('sucesso', 'Post excluído (junto com os comentários dele).');
    } else {
        flash('erro', 'Esse post não existe (talvez já tenha sido excluído).');
    }
    redirecionar('/admin/posts.php');
}

$lista = $posts->recentes();

$titulo = 'Posts';
$pagina = 'posts';
require RAIZ . '/views/admin/cabecalho.php';
?>

<div class="admin-titulo">
    <h1>Posts do blog (<?= count($lista) ?>)</h1>
    <a href="/admin/post-form.php" class="botao">+ Novo post</a>
</div>

<table class="tabela">
    <thead>
        <tr><th></th><th>Título</th><th>Sobre</th><th>Data</th><th>💬</th><th></th></tr>
    </thead>
    <tbody>
        <?php foreach ($lista as $post): ?>
            <tr>
                <td><?= e($post['emoji']) ?></td>
                <td><strong><?= e($post['titulo']) ?></strong></td>
                <td><?= e($post['autor_nome'] ?? '—') ?></td>
                <td><?= data_br($post['publicado_em']) ?></td>
                <td><?= $post['total_comentarios'] ?></td>
                <td class="acoes">
                    <a href="/post.php?id=<?= e($post['slug']) ?>" target="_blank">Ver</a>
                    <a href="/admin/post-form.php?id=<?= $post['id'] ?>">Editar</a>
                    <?php $id_excluir = $post['id']; require RAIZ . '/views/admin/botao-excluir.php'; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require RAIZ . '/views/admin/rodape.php'; ?>
