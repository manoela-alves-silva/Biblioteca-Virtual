<?php
require __DIR__ . '/../src/bootstrap.php';

$erros = [];
$enviado = false;
$nome = '';
$email = '';
$mensagem = '';

// Só valida quando o formulário foi enviado.
if (eh_post()) {
    verificar_csrf();

    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $mensagem = trim($_POST['mensagem'] ?? '');

    if ($nome == '') {
        $erros[] = 'Conta pra gente o seu nome 😊';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erros[] = 'Esse e-mail não parece válido.';
    }
    if (mb_strlen($mensagem) < 10) {
        $erros[] = 'A mensagem precisa ter pelo menos 10 caracteres.';
    }

    // Sem erros = sucesso! (Um site de verdade enviaria um e-mail aqui.)
    $enviado = count($erros) == 0;
}

$titulo = 'Contato';
$pagina = 'contato';
require RAIZ . '/views/layout/cabecalho.php';
?>

<section class="cabecalho-pagina">
    <h1>Contato</h1>
    <p>Um formulário de exemplo para praticar validação em PHP.</p>
</section>

<div class="contato">
    <div class="contato-info">
        <div class="info-item">
            <span>🧪</span>
            <div><strong>É só um exercício</strong><br>Este formulário não envia mensagens para ninguém. Ele serve para treinar validação de dados.</div>
        </div>
        <div class="info-item">
            <span>📚</span>
            <div><strong>Não há loja</strong><br>A Estante Aberta é um projeto pessoal de estudos, sem fins lucrativos.</div>
        </div>
        <div class="info-item">
            <span>💡</span>
            <div><strong>Quer saber mais?</strong><br>Veja a página <a href="/sobre.php">Sobre o projeto</a>.</div>
        </div>
    </div>

    <?php if ($enviado): ?>
        <div class="caixa-sucesso">
            <span>💌</span>
            <h2>Formulário validado!</h2>
            <p>Tudo certo, <?= e($nome) ?>! Os dados passaram na validação. (Como é um exercício, nenhuma mensagem foi enviada.)</p>
            <a href="/" class="botao">Voltar para o início</a>
        </div>
    <?php else: ?>
        <form method="post" action="/contato.php" class="formulario">
            <?= csrf_campo() ?>

            <?php if ($erros): ?>
                <ul class="erros">
                    <?php foreach ($erros as $erro): ?>
                        <li><?= e($erro) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <label>Seu nome
                <input type="text" name="nome" value="<?= e($nome) ?>">
            </label>
            <label>Seu e-mail
                <input type="email" name="email" value="<?= e($email) ?>">
            </label>
            <label>Mensagem
                <textarea name="mensagem" rows="5"><?= e($mensagem) ?></textarea>
            </label>

            <button type="submit" class="botao">Enviar mensagem</button>
        </form>
    <?php endif; ?>
</div>

<?php require RAIZ . '/views/layout/rodape.php'; ?>
