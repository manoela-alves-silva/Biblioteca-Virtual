<?php
// Topo das páginas do painel. Precisa de: $titulo, $pagina
$menu_admin = [
    'painel'      => ['/admin/', '📊 Painel'],
    'livros'      => ['/admin/livros.php', '📚 Livros'],
    'autores'     => ['/admin/autores.php', '✍️ Autores'],
    'posts'       => ['/admin/posts.php', '📝 Posts'],
    'comentarios' => ['/admin/comentarios.php', '💬 Comentários'],
    'senha'       => ['/admin/senha.php', '🔑 Trocar senha'],
];
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($titulo) ?> | Admin · Estante Aberta</title>
    <meta name="color-scheme" content="light dark">
    <meta name="darkreader-lock">
    <script src="/js/tema.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,600;9..144,800&family=Nunito:wght@400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/estilo.css">
    <link rel="stylesheet" href="/css/admin.css">
</head>

<body class="admin">
    <aside class="admin-menu">
        <a href="/admin/" class="logo">📖 Admin</a>
        <nav>
            <?php foreach ($menu_admin as $chave => [$link, $rotulo]): ?>
                <a href="<?= $link ?>" class="<?= $pagina == $chave ? 'ativo' : '' ?>"><?= $rotulo ?></a>
            <?php endforeach; ?>
        </nav>
        <div class="admin-usuario">
            Olá, <?= e($auth->usuario()['nome']) ?>!<br>
            <a href="/" target="_blank">Ver site ↗</a> ·
            <a href="/admin/sair.php">Sair</a>
            <button type="button" id="botao-tema" class="botao-tema" title="Trocar tema">🌙</button>
        </div>
    </aside>

    <main class="admin-conteudo">
        <?php require RAIZ . '/views/componentes/mensagens.php'; ?>
