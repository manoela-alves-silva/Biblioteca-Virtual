<?php
require __DIR__ . '/../src/bootstrap.php';

// Clique no coração: coloca ou tira dos favoritos e volta para onde estava.
if (eh_post()) {
    verificar_csrf();

    $id = (int) ($_POST['id'] ?? 0);
    if ($livros->porId($id)) {
        $agora_e_favorito = $favoritos->alternar($id);
        flash('sucesso', $agora_e_favorito ? 'Adicionado aos favoritos ❤️' : 'Removido dos favoritos');
    }
    redirecionar(url_de_volta('/favoritos.php'));
}

$lista = $livros->porIds($favoritos->ids());

$titulo = 'Favoritos';
$pagina = 'favoritos';
require RAIZ . '/views/layout/cabecalho.php';
?>

<section class="cabecalho-pagina">
    <h1>Seus favoritos ❤️</h1>
    <p>Os livros que você marcou para não esquecer.</p>
</section>

<?php if (!$lista): ?>
    <div class="vazio">
        <span>🤍</span>
        <p>Você ainda não favoritou nenhum livro. Clique no coração das capas!</p>
        <a href="/livros.php" class="botao">Explorar a estante</a>
    </div>
<?php else: ?>
    <div class="grade-livros">
        <?php foreach ($lista as $livro): ?>
            <?php require RAIZ . '/views/componentes/card-livro.php'; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php require RAIZ . '/views/layout/rodape.php'; ?>
