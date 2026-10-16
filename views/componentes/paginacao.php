<?php
// Botões de página: « 1 2 3 »
// Precisa de: $pagina_atual, $total_paginas
// http_build_query monta a URL mantendo os filtros (busca, autor, ordem...).
if ($total_paginas <= 1) {
    return;
}
?>
<nav class="paginacao">
    <?php if ($pagina_atual > 1): ?>
        <a href="<?= e(link_pagina($pagina_atual - 1)) ?>">← Anterior</a>
    <?php endif; ?>

    <?php for ($numero = 1; $numero <= $total_paginas; $numero++): ?>
        <a href="<?= e(link_pagina($numero)) ?>" class="<?= $numero == $pagina_atual ? 'ativo' : '' ?>"><?= $numero ?></a>
    <?php endfor; ?>

    <?php if ($pagina_atual < $total_paginas): ?>
        <a href="<?= e(link_pagina($pagina_atual + 1)) ?>">Próxima →</a>
    <?php endif; ?>
</nav>
