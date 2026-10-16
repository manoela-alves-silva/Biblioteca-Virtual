<?php // Mostra as mensagens "flash" (ex: "Adicionado aos favoritos ❤️") ?>
<?php foreach (pegar_flashes() as $flash): ?>
    <div class="alerta alerta-<?= e($flash['tipo']) ?>"><?= e($flash['mensagem']) ?></div>
<?php endforeach; ?>
