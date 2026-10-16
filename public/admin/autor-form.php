<?php
require __DIR__ . '/../../src/bootstrap.php';
$auth->exigirLogin();

$id = isset($_GET['id']) ? (int) $_GET['id'] : null;
$autor = $id ? $autores->porId($id) : null;

if ($id && !$autor) {
    flash('erro', 'Autor não encontrado.');
    redirecionar('/admin/autores.php');
}

$dados = $autor ?? [
    'slug' => '', 'nome' => '', 'nome_completo' => '', 'nascimento' => '', 'falecimento' => '',
    'local_nascimento' => '', 'nacionalidade' => 'Brasil', 'foto' => '', 'foto_posicao' => 'center 25%',
    'foto_credito' => '', 'cor' => '#FF6B57', 'resumo' => '', 'biografia' => '', 'citacao' => '',
    'fonte_url' => '', 'citacao_fonte' => '', 'citacao_url' => '',
];
$erros = [];

if (eh_post()) {
    verificar_csrf();

    // Pega todos os campos de texto de uma vez.
    $campos_texto = ['nome', 'nome_completo', 'local_nascimento', 'nacionalidade', 'foto_posicao',
                     'foto_credito', 'cor', 'resumo', 'biografia', 'citacao', 'citacao_fonte',
                     'citacao_url', 'fonte_url'];
    foreach ($campos_texto as $campo) {
        $dados[$campo] = trim($_POST[$campo] ?? '');
    }
    $dados['nascimento'] = (int) ($_POST['nascimento'] ?? 0);
    $dados['falecimento'] = (int) ($_POST['falecimento'] ?? 0);

    // O slug é gerado a partir do nome: "Luiz Antonio Simas" -> "luiz-antonio-simas"
    $dados['slug'] = gerar_slug($dados['nome']);

    if ($dados['nome'] == '') {
        $erros[] = 'O nome é obrigatório.';
    } elseif ($autores->slugEmUso($dados['slug'], $id)) {
        $erros[] = 'Já existe alguém cadastrado com esse nome.';
    }
    if ($dados['nacionalidade'] == '') {
        $erros[] = 'Informe a nacionalidade.';
    }
    if ($dados['resumo'] == '' || $dados['biografia'] == '') {
        $erros[] = 'Resumo e biografia são obrigatórios.';
    }
    if (!preg_match('/^#[0-9a-fA-F]{6}$/', $dados['cor'])) {
        $erros[] = 'Cor inválida.';
    }
    // Os links são opcionais, mas se forem preenchidos precisam ser links de verdade.
    foreach (['fonte_url' => 'A fonte da biografia', 'citacao_url' => 'O link da citação'] as $campo => $nome) {
        if ($dados[$campo] != '' && !preg_match('#^https?://#', $dados[$campo])) {
            $erros[] = "$nome precisa ser um link começando com http:// ou https://";
        }
    }
    // Citação sem fonte não entra: só publicamos frases que dá para conferir.
    if ($dados['citacao'] != '' && ($dados['citacao_fonte'] == '' || $dados['citacao_url'] == '')) {
        $erros[] = 'Para publicar uma citação, informe de onde ela veio e um link para conferir.';
    }

    // Foto nova enviada?
    if (!$erros && !empty($_FILES['foto']['name'])) {
        try {
            $dados['foto'] = Upload::salvarFoto($_FILES['foto'], $dados['nome'], $config['tamanho_maximo_foto']);
        } catch (RuntimeException $erro) {
            $erros[] = $erro->getMessage();
        }
    }

    // Marcou "remover foto"?
    if (isset($_POST['remover_foto'])) {
        $dados['foto'] = '';
    }

    if (!$erros) {
        $autores->salvar($dados, $id);
        flash('sucesso', $id ? 'Autor atualizado!' : 'Autor cadastrado!');
        redirecionar('/admin/autores.php');
    }
}

$titulo = $id ? 'Editar autor' : 'Novo autor';
$pagina = 'autores';
require RAIZ . '/views/admin/cabecalho.php';
?>

<a href="/admin/autores.php" class="voltar">← Autores</a>
<h1><?= $titulo ?></h1>

<!-- enctype="multipart/form-data" é OBRIGATÓRIO para enviar arquivos -->
<form method="post" enctype="multipart/form-data" class="formulario formulario-admin">
    <?= csrf_campo() ?>

    <?php if ($erros): ?>
        <ul class="erros">
            <?php foreach ($erros as $erro): ?><li><?= e($erro) ?></li><?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <div class="linha">
        <label>Nome (como é conhecido) *
            <input type="text" name="nome" value="<?= e($dados['nome']) ?>" required>
        </label>
        <label>Nome completo
            <input type="text" name="nome_completo" value="<?= e($dados['nome_completo']) ?>">
        </label>
    </div>

    <div class="linha">
        <label>Nacionalidade *
            <input type="text" name="nacionalidade" value="<?= e($dados['nacionalidade']) ?>" required>
        </label>
        <label>Local de nascimento
            <input type="text" name="local_nascimento" value="<?= e($dados['local_nascimento']) ?>">
        </label>
        <label>Ano de nascimento
            <input type="number" name="nascimento" value="<?= e((string) $dados['nascimento']) ?>">
        </label>
        <label>Ano de falecimento
            <input type="number" name="falecimento" value="<?= e((string) $dados['falecimento']) ?>">
        </label>
    </div>

    <fieldset class="caixa-foto">
        <legend>Foto</legend>
        <div class="previa-foto">
            <?php $autor = $dados; $classe_foto = 'redonda'; require RAIZ . '/views/componentes/foto-autor.php'; ?>
        </div>
        <div>
            <label>Enviar nova foto (JPG, PNG ou WEBP, até 2 MB)
                <input type="file" name="foto" accept="image/jpeg,image/png,image/webp">
            </label>
            <div class="linha">
                <label>Crédito da foto
                    <input type="text" name="foto_credito" value="<?= e($dados['foto_credito']) ?>" placeholder="ex: Fulano · CC BY 4.0">
                </label>
                <label>Enquadramento
                    <input type="text" name="foto_posicao" value="<?= e($dados['foto_posicao']) ?>" placeholder="center 25%">
                    <small>Horizontal e vertical. Ex: "center 20%" sobe a foto.</small>
                </label>
            </div>
            <?php if ($dados['foto']): ?>
                <label class="checkbox"><input type="checkbox" name="remover_foto"> Remover foto atual</label>
            <?php endif; ?>
        </div>
    </fieldset>

    <label>Resumo (aparece no card) *
        <input type="text" name="resumo" value="<?= e($dados['resumo']) ?>" maxlength="140" required>
    </label>

    <label>Biografia *
        <textarea name="biografia" rows="8" required><?= e($dados['biografia']) ?></textarea>
        <small>Deixe uma linha em branco entre os parágrafos.</small>
    </label>

    <label>Fonte das informações (link)
        <input type="url" name="fonte_url" value="<?= e($dados['fonte_url']) ?>" placeholder="https://pt.wikipedia.org/wiki/...">
        <small>De onde vieram os dados da biografia. Aparece na página do autor.</small>
    </label>

    <fieldset class="caixa-foto caixa-citacao">
        <legend>Citação (opcional)</legend>
        <label>Frase
            <input type="text" name="citacao" value="<?= e($dados['citacao']) ?>">
            <small>Só coloque frases que você conseguiu confirmar numa fonte.</small>
        </label>
        <div class="linha">
            <label>De onde veio
                <input type="text" name="citacao_fonte" value="<?= e($dados['citacao_fonte']) ?>" placeholder="ex: Quarto de despejo (1960)">
            </label>
            <label>Link para conferir
                <input type="url" name="citacao_url" value="<?= e($dados['citacao_url']) ?>" placeholder="https://...">
            </label>
        </div>
    </fieldset>

    <label>Cor
        <input type="color" name="cor" value="<?= e($dados['cor']) ?>">
    </label>

    <button type="submit" class="botao">Salvar</button>
</form>

<?php require RAIZ . '/views/admin/rodape.php'; ?>
