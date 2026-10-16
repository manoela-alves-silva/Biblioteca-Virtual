<?php
// Capa de livro feita só com CSS.
// Precisa de: $livro. Opcional: $classe_capa ("capa-grande", "capa-mini")
$classe_capa = $classe_capa ?? '';
?>
<div class="capa <?= $classe_capa ?>" style="--cor: <?= e($livro['cor']) ?>">
    <span class="capa-titulo"><?= e($livro['titulo']) ?></span>
    <span class="capa-autora"><?= e($livro['autor_nome']) ?></span>
</div>
