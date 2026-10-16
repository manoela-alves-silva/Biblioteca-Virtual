<?php
// Mostra de onde veio a citação, com link para conferir.
// Precisa de: $autor (com citacao_fonte e citacao_url)
?>
<?php if (!empty($autor['citacao_fonte'])): ?>
    <cite class="fonte-citacao">
        <?= e($autor['citacao_fonte']) ?>
        <?php if (!empty($autor['citacao_url'])): ?>
            · <a href="<?= e($autor['citacao_url']) ?>" target="_blank" rel="noopener">conferir ↗</a>
        <?php endif; ?>
    </cite>
<?php endif; ?>
