<?php
// Topo de todas as páginas do site.
// Antes de incluir, a página define:
//   $titulo -> texto da aba do navegador
//   $pagina -> qual item do menu fica destacado
$menu = [
    'home'    => ['/', 'Início'],
    'livros'  => ['/livros.php', 'Livros'],
    'autores' => ['/autores.php', 'Autoras & Autores'],
    'blog'    => ['/blog.php', 'Blog'],
    'sobre'   => ['/sobre.php', 'Sobre'],
    'contato' => ['/contato.php', 'Contato'],
];
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($titulo) ?> | <?= e($config['nome_site']) ?></title>
    <meta name="description" content="Projeto pessoal de estudos, sem fins lucrativos: biografias e livros de autoras e autores negros, indígenas e brasileiros.">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>📖</text></svg>">

    <!-- O site tem modo claro e escuro próprios. -->
    <meta name="color-scheme" content="light dark">
    <!-- Avisa a extensão Dark Reader para não mexer nas cores (o site já tem modo escuro). -->
    <meta name="darkreader-lock">
    <script src="/js/tema.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,600;9..144,800&family=Nunito:wght@400;600;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/css/estilo.css">
</head>

<body>

    <div class="faixa-aviso">
        📚 Projeto pessoal de estudos · sem fins lucrativos · nada é vendido aqui.
        <a href="/sobre.php">Saiba mais</a>
    </div>

    <header class="topo">
        <div class="container topo-conteudo">
            <a href="/" class="logo">📖 Estante <span>Aberta</span></a>

            <nav class="menu">
                <?php foreach ($menu as $chave => [$link, $rotulo]): ?>
                    <a href="<?= $link ?>" class="<?= $pagina == $chave ? 'ativo' : '' ?>"><?= $rotulo ?></a>
                <?php endforeach; ?>

                <a href="/favoritos.php" class="icone <?= $pagina == 'favoritos' ? 'ativo' : '' ?>" title="Favoritos">
                    ❤️ <span class="bolinha"><?= $favoritos->total() ?></span>
                </a>
                <button type="button" id="botao-tema" class="botao-tema" title="Trocar tema">🌙</button>
            </nav>
        </div>
    </header>

    <main class="container">
        <?php require RAIZ . '/views/componentes/mensagens.php'; ?>
