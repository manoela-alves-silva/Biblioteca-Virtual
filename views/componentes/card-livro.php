<?php
// Card de um livro (usado dentro de um foreach).
// Precisa de: $livro, $favoritos
$eh_favorito = $favoritos->contem($livro['id']);
?>
<article class="card-livro">
    <div class="card-capa">
        <a href="/livro.php?id=<?= $livro['id'] ?>">
            <?php $classe_capa = ''; require RAIZ . '/views/componentes/capa.php'; ?>
        </a>

        <form method="post" action="/favoritos.php" class="form-coracao">
            <?= csrf_campo() ?>
            <input type="hidden" name="id" value="<?= $livro['id'] ?>">
            <input type="hidden" name="voltar" value="<?= e($_SERVER['REQUEST_URI']) ?>">
            <button type="submit" class="coracao <?= $eh_favorito ? 'ativo' : '' ?>"
                    title="<?= $eh_favorito ? 'Tirar dos favoritos' : 'Adicionar aos favoritos' ?>">
                <?= $eh_favorito ? '❤️' : '🤍' ?>
            </button>
        </form>
    </div>

    <div class="card-info">
        <h3><a href="/livro.php?id=<?= $livro['id'] ?>"><?= e($livro['titulo']) ?></a></h3>
        <a href="/autor.php?id=<?= e($livro['autor_slug']) ?>" class="nome-autora"><?= e($livro['autor_nome']) ?></a>

        <?php if ($livro['ano']): ?>
            <span class="etiqueta"><?= $livro['ano'] ?></span>
        <?php endif; ?>
    </div>
</article>
