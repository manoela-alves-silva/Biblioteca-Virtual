<?php
require __DIR__ . '/../src/bootstrap.php';

// 1. Lê os filtros da URL (ex: livros.php?busca=amor&ordem=recentes)
$filtros = [
    'busca'          => trim($_GET['busca'] ?? ''),
    'autor'          => $_GET['autor'] ?? '',
    'ordem'          => $_GET['ordem'] ?? 'titulo',
];

// 2. Paginação: qual página estamos e quantos livros pular.
$por_pagina    = $config['livros_por_pagina'];
$total_livros  = $livros->contar($filtros);
$total_paginas = max(1, (int) ceil($total_livros / $por_pagina));
$pagina_atual  = min(max(1, (int) ($_GET['pagina'] ?? 1)), $total_paginas);

$lista = $livros->buscar($filtros, $por_pagina, ($pagina_atual - 1) * $por_pagina);
$opcoes_autores = $autores->todos();

$tem_filtro = $filtros['busca'] != '' || $filtros['autor'] != '';

// 3. Mostra a página
$titulo = 'Livros';
$pagina = 'livros';
require RAIZ . '/views/layout/cabecalho.php';
?>

<section class="cabecalho-pagina">
    <h1>A estante</h1>
    <p>Use a busca, os filtros e a ordenação para descobrir a sua próxima leitura.</p>
</section>

<form class="filtros" method="get" action="/livros.php">
    <input type="search" name="busca" placeholder="🔍 Título ou autor..." value="<?= e($filtros['busca']) ?>">

    <select name="autor" aria-label="Filtrar por autor">
        <option value="">Todas as pessoas</option>
        <?php foreach ($opcoes_autores as $autor): ?>
            <option value="<?= e($autor['slug']) ?>" <?= $filtros['autor'] == $autor['slug'] ? 'selected' : '' ?>>
                <?= e($autor['nome']) ?> (<?= $autor['total_livros'] ?>)
            </option>
        <?php endforeach; ?>
    </select>

    <select name="ordem" aria-label="Ordenar por">
        <?php foreach (LivroRepositorio::ORDENS as $chave => $ordem): ?>
            <option value="<?= $chave ?>" <?= $filtros['ordem'] == $chave ? 'selected' : '' ?>><?= $ordem['rotulo'] ?></option>
        <?php endforeach; ?>
    </select>

    <button type="submit" class="botao">Filtrar</button>

    <?php if ($tem_filtro): ?>
        <a href="/livros.php" class="limpar">Limpar</a>
    <?php endif; ?>
</form>

<p class="contador"><?= $total_livros ?> livro(s) encontrado(s)</p>

<?php if ($total_livros == 0): ?>
    <div class="vazio">
        <span>🙈</span>
        <p>Nenhum livro encontrado. Que tal tentar outra busca?</p>
    </div>
<?php else: ?>
    <div class="grade-livros">
        <?php foreach ($lista as $livro): ?>
            <?php require RAIZ . '/views/componentes/card-livro.php'; ?>
        <?php endforeach; ?>
    </div>

    <?php require RAIZ . '/views/componentes/paginacao.php'; ?>
<?php endif; ?>

<?php require RAIZ . '/views/layout/rodape.php'; ?>
