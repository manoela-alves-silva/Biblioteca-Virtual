<?php
require __DIR__ . '/../../src/bootstrap.php';

// Já está logado? Vai direto pro painel.
if ($auth->logado()) {
    redirecionar('/admin/');
}

$email = '';

if (eh_post()) {
    verificar_csrf();

    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if ($auth->entrar($email, $senha)) {
        flash('sucesso', 'Que bom te ver de novo! 👋');
        redirecionar('/admin/');
    }

    // Mensagem genérica de propósito: não dizemos se o erro foi no e-mail ou na senha.
    flash('erro', 'E-mail ou senha incorretos.');
    redirecionar('/admin/login.php');
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrar | Admin · Estante Aberta</title>
    <meta name="color-scheme" content="light dark">
    <meta name="darkreader-lock">
    <script src="/js/tema.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,800&family=Nunito:wght@400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/estilo.css">
    <link rel="stylesheet" href="/css/admin.css">
</head>

<body class="tela-login">
    <form method="post" class="formulario caixa-login">
        <?= csrf_campo() ?>
        <h1>📖 Estante Aberta · admin</h1>
        <p>Entre para cadastrar livros, autores e posts.</p>

        <?php require RAIZ . '/views/componentes/mensagens.php'; ?>

        <label>E-mail
            <input type="email" name="email" value="<?= e($email) ?>" required autofocus>
        </label>
        <label>Senha
            <input type="password" name="senha" required>
        </label>
        <button type="submit" class="botao botao-cheio">Entrar</button>
        <a href="/" class="voltar">← Voltar para o site</a>
    </form>
</body>

</html>
