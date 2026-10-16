<?php
// =====================================================================
// INSTALADOR DO BANCO
// - Na primeira vez que o site abre, o bootstrap chama instalar_banco().
// - Para APAGAR TUDO e recomeçar do zero, rode no terminal:
//       php database/instalar.php
// =====================================================================

function instalar_banco(PDO $pdo): void
{
    // 1. Cria as tabelas.
    $pdo->exec(file_get_contents(__DIR__ . '/schema.sql'));

    $dados = require __DIR__ . '/dados-iniciais.php';

    // Transação: ou salva TUDO, ou não salva nada (se der erro no meio).
    $pdo->beginTransaction();

    // 2. Autores. Guardamos slug => id para ligar os livros depois.
    $ids_autores = [];
    $sql = $pdo->prepare(
        'INSERT INTO autores (slug, nome, nome_completo, nascimento, falecimento, local_nascimento,
                              nacionalidade, foto, foto_posicao, foto_credito, cor, resumo, biografia,
                              citacao, citacao_fonte, citacao_url, fonte_url)
         VALUES (:slug, :nome, :nome_completo, :nascimento, :falecimento, :local_nascimento,
                 :nacionalidade, :foto, :foto_posicao, :foto_credito, :cor, :resumo, :biografia,
                 :citacao, :citacao_fonte, :citacao_url, :fonte_url)'
    );
    foreach ($dados['autores'] as $autor) {
        $sql->execute([
            'slug' => $autor['slug'],
            'nome' => $autor['nome'],
            'nome_completo' => $autor['nome_completo'] ?? null,
            'nascimento' => $autor['nascimento'] ?? null,
            'falecimento' => $autor['falecimento'] ?? null,
            'local_nascimento' => $autor['local_nascimento'] ?? null,
            'nacionalidade' => $autor['nacionalidade'],
            'foto' => $autor['foto'] ?? null,
            'foto_posicao' => $autor['foto_posicao'] ?? 'center 25%',
            'foto_credito' => $autor['foto_credito'] ?? null,
            'cor' => $autor['cor'],
            'resumo' => $autor['resumo'],
            'biografia' => $autor['biografia'],
            'citacao' => $autor['citacao'] ?? null,
            'citacao_fonte' => $autor['citacao_fonte'] ?? null,
            'citacao_url' => $autor['citacao_url'] ?? null,
            'fonte_url' => $autor['fonte_url'] ?? null,
        ]);
        $ids_autores[$autor['slug']] = $pdo->lastInsertId();
    }

    // 3. Livros.
    $sql = $pdo->prepare(
        'INSERT INTO livros (autor_id, titulo, coautoria, ano, sinopse, cor, destaque)
         VALUES (:autor_id, :titulo, :coautoria, :ano, :sinopse, :cor, :destaque)'
    );
    foreach ($dados['livros'] as $livro) {
        $sql->execute([
            'autor_id' => $ids_autores[$livro['autor']],
            'titulo' => $livro['titulo'],
            'coautoria' => $livro['coautoria'] ?? null,
            'ano' => $livro['ano'],
            'sinopse' => $livro['sinopse'],
            'cor' => $livro['cor'],
            'destaque' => $livro['destaque'] ?? 0,
        ]);
    }

    // 4. Posts.
    $ids_posts = [];
    $sql = $pdo->prepare(
        'INSERT INTO posts (slug, titulo, resumo, conteudo, emoji, autor_id, publicado_em)
         VALUES (:slug, :titulo, :resumo, :conteudo, :emoji, :autor_id, :publicado_em)'
    );
    foreach ($dados['posts'] as $post) {
        $sql->execute([
            'slug' => $post['slug'],
            'titulo' => $post['titulo'],
            'resumo' => $post['resumo'],
            'conteudo' => $post['conteudo'],
            'emoji' => $post['emoji'],
            'autor_id' => $ids_autores[$post['autor']] ?? null,
            'publicado_em' => $post['publicado_em'],
        ]);
        $ids_posts[$post['slug']] = $pdo->lastInsertId();
    }

    // 5. Comentários de exemplo.
    $sql = $pdo->prepare('INSERT INTO comentarios (post_id, nome, texto) VALUES (:post_id, :nome, :texto)');
    foreach ($dados['comentarios'] as $comentario) {
        $sql->execute([
            'post_id' => $ids_posts[$comentario['post']],
            'nome' => $comentario['nome'],
            'texto' => $comentario['texto'],
        ]);
    }

    // 6. Usuário do painel. password_hash embaralha a senha de forma segura.
    $sql = $pdo->prepare('INSERT INTO usuarios (nome, email, senha_hash) VALUES (:nome, :email, :senha_hash)');
    foreach ($dados['usuarios'] as $usuario) {
        $sql->execute([
            'nome' => $usuario['nome'],
            'email' => $usuario['email'],
            'senha_hash' => password_hash($usuario['senha'], PASSWORD_DEFAULT),
        ]);
    }

    $pdo->commit();
}

// Este trecho só roda quando o arquivo é executado direto no terminal.
if (PHP_SAPI === 'cli' && realpath($_SERVER['argv'][0] ?? '') === __FILE__) {
    require_once __DIR__ . '/../src/bootstrap.php';
    instalar_banco($pdo);
    echo "✅ Banco recriado com sucesso em: {$config['banco']}\n";
}
