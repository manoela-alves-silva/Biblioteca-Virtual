<?php
require __DIR__ . '/../../src/bootstrap.php';
$auth->exigirLogin();

// Se tem ?id= na URL, estamos EDITANDO. Senão, CRIANDO.
$id = isset($_GET['id']) ? (int) $_GET['id'] : null;
$livro = $id ? $livros->porId($id) : null;

if ($id && !$livro) {
    flash('erro', 'Livro não encontrado.');
    redirecionar('/admin/livros.php');
}

// Valores do formulário: os do livro (edição) ou vazios (novo).
$dados = $livro ?? [
    'autor_id' => '', 'titulo' => '', 'coautoria' => '', 'ano' => '', 'sinopse' => '',
    'cor' => '#FF6B57', 'destaque' => 0,
];
$erros = [];

if (eh_post()) {
    verificar_csrf();

    $dados = [
        'autor_id'  => (int) ($_POST['autor_id'] ?? 0),
        'titulo'    => trim($_POST['titulo'] ?? ''),
        'coautoria' => trim($_POST['coautoria'] ?? ''),
        'ano'       => (int) ($_POST['ano'] ?? 0),
        'sinopse'   => trim($_POST['sinopse'] ?? ''),
        'cor'       => $_POST['cor'] ?? '#FF6B57',
        'destaque'  => isset($_POST['destaque']),
    ];

    // Validações
    if (!$autores->porId($dados['autor_id'])) {
        $erros[] = 'Escolha o autor.';
    }
    if ($dados['titulo'] == '') {
        $erros[] = 'O título é obrigatório.';
    }
    if ($dados['sinopse'] == '') {
        $erros[] = 'Escreva uma sinopse.';
    }
    if (!preg_match('/^#[0-9a-fA-F]{6}$/', $dados['cor'])) {
        $erros[] = 'Cor inválida.';
    }

    if (!$erros) {
        $livros->salvar($dados, $id);
        flash('sucesso', $id ? 'Livro atualizado!' : 'Livro cadastrado!');
        redirecionar('/admin/livros.php');
    }
}

$titulo = $id ? 'Editar livro' : 'Novo livro';
$pagina = 'livros';
require RAIZ . '/views/admin/cabecalho.php';
?>

<a href="/admin/livros.php" class="voltar">← Livros</a>
<h1><?= $titulo ?></h1>

<form method="post" class="formulario formulario-admin">
    <?= csrf_campo() ?>

    <?php if ($erros): ?>
        <ul class="erros">
            <?php foreach ($erros as $erro): ?><li><?= e($erro) ?></li><?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <label>Título *
        <input type="text" name="titulo" value="<?= e($dados['titulo']) ?>" required>
    </label>

    <div class="linha">
        <label>Autor *
            <select name="autor_id" required>
                <option value="">Escolha...</option>
                <?php foreach ($autores->opcoes() as $autor_id => $nome): ?>
                    <option value="<?= $autor_id ?>" <?= $dados['autor_id'] == $autor_id ? 'selected' : '' ?>><?= e($nome) ?></option>
                <?php endforeach; ?>
            </select>
            <small>Não está na lista? <a href="/admin/autor-form.php">Cadastre o autor primeiro</a>.</small>
        </label>
        <label>Coautoria
            <input type="text" name="coautoria" value="<?= e($dados['coautoria']) ?>" placeholder="ex: com Luiz Rufino">
        </label>
    </div>

    <label>Sinopse *
        <textarea name="sinopse" rows="4" required><?= e($dados['sinopse']) ?></textarea>
    </label>

    <div class="linha">
        <label>Ano
            <input type="number" name="ano" value="<?= e((string) $dados['ano']) ?>" min="1500" max="2100">
        </label>
        <label>Cor da capa
            <input type="color" name="cor" value="<?= e($dados['cor']) ?>">
        </label>
    </div>

    <label class="checkbox">
        <input type="checkbox" name="destaque" <?= $dados['destaque'] ? 'checked' : '' ?>>
        ⭐ Mostrar nos destaques da página inicial
    </label>

    <button type="submit" class="botao">Salvar</button>
</form>

<?php require RAIZ . '/views/admin/rodape.php'; ?>
