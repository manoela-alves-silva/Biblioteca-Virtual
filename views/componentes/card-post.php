<?php
// Card de um post do blog. Precisa de: $post
?>
<a href="/post.php?id=<?= e($post['slug']) ?>" class="card-post">
    <span class="post-emoji" style="--cor: <?= e($post['autor_cor'] ?? '#FF6B57') ?>"><?= e($post['emoji']) ?></span>
    <div>
        <span class="post-data">
            <?= data_br($post['publicado_em']) ?>
            <?php if ($post['total_comentarios'] > 0): ?>
                · 💬 <?= $post['total_comentarios'] ?>
            <?php endif; ?>
        </span>
        <h3><?= e($post['titulo']) ?></h3>
        <p><?= e($post['resumo']) ?></p>
    </div>
</a>
