<?php
require __DIR__ . '/../../src/bootstrap.php';
$auth->exigirLogin();

$id = isset($_GET['id']) ? (int) $_GET['id'] : null;
$post = $id ? $posts->porId($id) : null;

if ($id && !$post) {
    flash('erro', 'Post não encontrado.');
    redirecionar('/admin/posts.php');
}

$dados = $post ?? [
    'titulo' => '', 'resumo' => '', 'conteudo' => '', 'emoji' => '📚',
    'autor_id' => '', 'publicado_em' => date('Y-m-d'),
];
$erros = [];

if (eh_post()) {
    verificar_csrf();

    $dados = [
        'titulo'       => trim($_POST['titulo'] ?? ''),
        'resumo'       => trim($_POST['resumo'] ?? ''),
        'conteudo'     => trim($_POST['conteudo'] ?? ''),
        'emoji'        => trim($_POST['emoji'] ?? ''),
        'autor_id'     => (int) ($_POST['autor_id'] ?? 0),
        'publicado_em' => $_POST['publicado_em'] ?? date('Y-m-d'),
    ];
    $dados['slug'] = gerar_slug($dados['titulo']);

    if ($dados['titulo'] == '') {
        $erros[] = 'O título é obrigatório.';
    } elseif ($posts->slugEmUso($dados['slug'], $id)) {
        $erros[] = 'Já existe um post com esse título.';
    }
    if ($dados['resumo'] == '' || $dados['conteudo'] == '') {
        $erros[] = 'Resumo e conteúdo são obrigatórios.';
    }
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $dados['publicado_em'])) {
        $erros[] = 'Data inválida.';
    }

    if (!$erros) {
        $posts->salvar($dados, $id);
        flash('sucesso', $id ? 'Post atualizado!' : 'Post publicado!');
        redirecionar('/admin/posts.php');
    }
}

$titulo = $id ? 'Editar post' : 'Novo post';
$pagina = 'posts';
require RAIZ . '/views/admin/cabecalho.php';
?>

<a href="/admin/posts.php" class="voltar">← Posts</a>
<h1><?= $titulo ?></h1>

<form method="post" class="formulario formulario-admin">
    <?= csrf_campo() ?>

    <?php if ($erros): ?>
        <ul class="erros">
            <?php foreach ($erros as $erro): ?><li><?= e($erro) ?></li><?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <div class="linha">
        <label class="campo-emoji">Emoji
            <input type="text" name="emoji" value="<?= e($dados['emoji']) ?>" maxlength="8">
        </label>
        <label>Título *
            <input type="text" name="titulo" value="<?= e($dados['titulo']) ?>" required>
        </label>
    </div>

    <label>Resumo *
        <input type="text" name="resumo" value="<?= e($dados['resumo']) ?>" maxlength="160" required>
    </label>

    <label>Conteúdo *
        <textarea name="conteudo" rows="10" required><?= e($dados['conteudo']) ?></textarea>
        <small>Deixe uma linha em branco entre os parágrafos.</small>
    </label>

    <div class="linha">
        <label>Sobre quem é o post?
            <select name="autor_id">
                <option value="">Ninguém específico</option>
                <?php foreach ($autores->opcoes() as $autor_id => $nome): ?>
                    <option value="<?= $autor_id ?>" <?= $dados['autor_id'] == $autor_id ? 'selected' : '' ?>><?= e($nome) ?></option>
                <?php endforeach; ?>
            </select>
        </label>
        <label>Data de publicação
            <input type="date" name="publicado_em" value="<?= e($dados['publicado_em']) ?>">
        </label>
    </div>

    <button type="submit" class="botao">Salvar</button>
</form>

<?php require RAIZ . '/views/admin/rodape.php'; ?>
