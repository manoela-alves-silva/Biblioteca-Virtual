<?php
require __DIR__ . '/../../src/bootstrap.php';
$auth->exigirLogin();

if (eh_post() && ($_POST['acao'] ?? '') == 'excluir') {
    verificar_csrf();
    $id = (int) $_POST['id'];
    if (!$autores->porId($id)) {
        flash('erro', 'Esse autor não existe (talvez já tenha sido excluído).');
    } elseif ($autores->excluir($id)) {
        flash('sucesso', 'Autor excluído.');
    } else {
        flash('erro', 'Esse autor ainda tem livros cadastrados. Exclua ou troque o autor dos livros primeiro.');
    }
    redirecionar('/admin/autores.php');
}

$lista = $autores->todos();

$titulo = 'Autores';
$pagina = 'autores';
require RAIZ . '/views/admin/cabecalho.php';
?>

<div class="admin-titulo">
    <h1>Autoras & Autores (<?= count($lista) ?>)</h1>
    <a href="/admin/autor-form.php" class="botao">+ Novo autor</a>
</div>

<table class="tabela">
    <thead>
        <tr><th></th><th>Nome</th><th>Nacionalidade</th><th>Livros</th><th></th></tr>
    </thead>
    <tbody>
        <?php foreach ($lista as $autor): ?>
            <tr>
                <td class="celula-foto"><?php $classe_foto = 'redonda'; require RAIZ . '/views/componentes/foto-autor.php'; ?></td>
                <td>
                    <strong><?= e($autor['nome']) ?></strong>
                    <?= !$autor['foto'] ? '<br><small>📷 sem foto</small>' : '' ?>
                </td>
                <td><?= e($autor['nacionalidade']) ?></td>
                <td><?= $autor['total_livros'] ?></td>
                <td class="acoes">
                    <a href="/autor.php?id=<?= e($autor['slug']) ?>" target="_blank">Ver</a>
                    <a href="/admin/autor-form.php?id=<?= $autor['id'] ?>">Editar</a>
                    <?php $id_excluir = $autor['id']; require RAIZ . '/views/admin/botao-excluir.php'; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require RAIZ . '/views/admin/rodape.php'; ?>
