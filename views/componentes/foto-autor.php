<?php
// Foto de um autor. Se não tiver foto, mostra um avatar com as iniciais.
// Precisa de: $autor (com nome, foto, foto_posicao e cor)
// Opcional:   $classe_foto (classe CSS extra)
$classe_foto = $classe_foto ?? '';
?>
<?php if (!empty($autor['foto'])): ?>
    <img src="/img/autores/<?= e($autor['foto']) ?>"
         alt="Foto de <?= e($autor['nome']) ?>"
         class="foto-autor <?= $classe_foto ?>"
         style="object-position: <?= e($autor['foto_posicao'] ?? 'center') ?>; --cor: <?= e($autor['cor']) ?>"
         loading="lazy">
<?php else: ?>
    <div class="foto-autor avatar <?= $classe_foto ?>" style="--cor: <?= e($autor['cor']) ?>" role="img" aria-label="<?= e($autor['nome']) ?>">
        <span><?= e(iniciais($autor['nome'])) ?></span>
    </div>
<?php endif; ?>
