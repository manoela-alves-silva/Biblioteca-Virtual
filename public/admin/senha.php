<?php
require __DIR__ . '/../../src/bootstrap.php';
$auth->exigirLogin();

$erros = [];

if (eh_post()) {
    verificar_csrf();

    $atual = $_POST['senha_atual'] ?? '';
    $nova = $_POST['senha_nova'] ?? '';
    $confirmacao = $_POST['confirmacao'] ?? '';

    if (mb_strlen($nova) < 8) {
        $erros[] = 'A nova senha precisa ter pelo menos 8 caracteres.';
    }
    if ($nova !== $confirmacao) {
        $erros[] = 'A confirmação não é igual à nova senha.';
    }
    if ($nova === $atual) {
        $erros[] = 'A nova senha precisa ser diferente da atual.';
    }

    // Só tenta trocar se as regras acima passaram.
    if (!$erros) {
        if ($auth->trocarSenha($atual, $nova)) {
            flash('sucesso', 'Senha trocada! Use a nova senha no próximo login. 🔑');
            redirecionar('/admin/');
        }
        $erros[] = 'A senha atual está incorreta.';
    }
}

$titulo = 'Trocar senha';
$pagina = 'senha';
require RAIZ . '/views/admin/cabecalho.php';
?>

<h1>Trocar senha</h1>

<form method="post" class="formulario formulario-admin formulario-senha">
    <?= csrf_campo() ?>

    <?php if ($erros): ?>
        <ul class="erros">
            <?php foreach ($erros as $erro): ?><li><?= e($erro) ?></li><?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <!-- Não preenchemos os campos de volta: senha nunca deve reaparecer na tela. -->
    <label>Senha atual
        <input type="password" name="senha_atual" required autocomplete="current-password">
    </label>
    <label>Nova senha
        <input type="password" name="senha_nova" minlength="8" required autocomplete="new-password">
        <small>Pelo menos 8 caracteres. Dica: uma frase curta é fácil de lembrar e difícil de adivinhar.</small>
    </label>
    <label>Repita a nova senha
        <input type="password" name="confirmacao" minlength="8" required autocomplete="new-password">
    </label>

    <button type="submit" class="botao">Salvar nova senha</button>
</form>

<?php require RAIZ . '/views/admin/rodape.php'; ?>
