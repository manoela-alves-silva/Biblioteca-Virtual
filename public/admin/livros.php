<?php
require __DIR__ . '/../../src/bootstrap.php';
$auth->exigirLogin();

// Excluir
if (eh_post() && ($_POST['acao'] ?? '') == 'excluir') {
    verificar_csrf();
    if ($livros->excluir((int) $_POST['id'])) {
        flash('sucesso', 'Livro excluído.');
    } else {
        flash('erro', 'Esse livro não existe (talvez já tenha sido excluído).');
    }
    redirecionar('/admin/livros.php');
}

$busca = trim($_GET['busca'] ?? '');
$lista = $livros->buscar(['busca' => $busca], 500);

$titulo = 'Livros';
$pagina = 'livros';
require RAIZ . '/views/admin/cabecalho.php';
?>

<div class="admin-titulo">
    <h1>Livros (<?= count($lista) ?>)</h1>
    <a href="/admin/livro-form.php" class="botao">+ Novo livro</a>
</div>

<form class="filtros filtros-esquerda">
    <input type="search" name="busca" placeholder="Buscar título ou autor..." value="<?= e($busca) ?>">
    <button class="botao botao-claro">Buscar</button>
</form>

<table class="tabela">
    <thead>
        <tr><th></th><th>Título</th><th>Autor</th><th>Ano</th><th></th></tr>
    </thead>
    <tbody>
        <?php foreach ($lista as $livro): ?>
            <tr>
                <td><span class="bolinha-cor" style="background: <?= e($livro['cor']) ?>"></span></td>
                <td>
                    <strong><?= e($livro['titulo']) ?></strong>
                    <?= $livro['destaque'] ? '<span title="Destaque">⭐</span>' : '' ?>
                </td>
                <td><?= e($livro['autor_nome']) ?></td>
                <td><?= $livro['ano'] ?: '—' ?></td>
                <td class="acoes">
                    <a href="/livro.php?id=<?= $livro['id'] ?>" target="_blank">Ver</a>
                    <a href="/admin/livro-form.php?id=<?= $livro['id'] ?>">Editar</a>
                    <?php $id_excluir = $livro['id']; require RAIZ . '/views/admin/botao-excluir.php'; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require RAIZ . '/views/admin/rodape.php'; ?>
