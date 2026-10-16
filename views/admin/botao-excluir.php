<?php
// Botão de excluir com confirmação. Precisa de: $id_excluir
?>
<form method="post" class="form-inline" onsubmit="return confirm('Tem certeza que quer excluir? Não dá para desfazer.');">
    <?= csrf_campo() ?>
    <input type="hidden" name="acao" value="excluir">
    <input type="hidden" name="id" value="<?= $id_excluir ?>">
    <button type="submit" class="link-perigo">Excluir</button>
</form>
