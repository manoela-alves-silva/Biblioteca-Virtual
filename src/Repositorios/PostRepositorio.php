<?php
// =====================================================================
// PostRepositorio: consultas da tabela "posts" (blog).
// =====================================================================

class PostRepositorio
{
    private PDO $pdo;

    // Traz junto o autor relacionado e quantos comentários o post tem.
    private const SELECT_BASE =
        'SELECT p.*, a.nome AS autor_nome, a.slug AS autor_slug, a.cor AS autor_cor,
                (SELECT COUNT(*) FROM comentarios c WHERE c.post_id = p.id) AS total_comentarios
         FROM posts p
         LEFT JOIN autores a ON a.id = p.autor_id';

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Os mais novos primeiro. Se $limite for null, traz todos.
    public function recentes(?int $limite = null): array
    {
        $sql = self::SELECT_BASE . ' ORDER BY p.publicado_em DESC, p.id DESC';
        if ($limite !== null) {
            $sql .= ' LIMIT ' . (int) $limite;
        }
        return $this->pdo->query($sql)->fetchAll();
    }

    public function doAutor(int $autor_id): array
    {
        $sql = $this->pdo->prepare(self::SELECT_BASE . ' WHERE p.autor_id = :id ORDER BY p.publicado_em DESC');
        $sql->execute(['id' => $autor_id]);
        return $sql->fetchAll();
    }

    public function porSlug(string $slug): ?array
    {
        $sql = $this->pdo->prepare(self::SELECT_BASE . ' WHERE p.slug = :slug');
        $sql->execute(['slug' => $slug]);
        return $sql->fetch() ?: null;
    }

    public function porId(int $id): ?array
    {
        $sql = $this->pdo->prepare(self::SELECT_BASE . ' WHERE p.id = :id');
        $sql->execute(['id' => $id]);
        return $sql->fetch() ?: null;
    }

    public function slugEmUso(string $slug, ?int $ignorar_id = null): bool
    {
        $sql = $this->pdo->prepare('SELECT COUNT(*) FROM posts WHERE slug = :slug AND id != :id');
        $sql->execute(['slug' => $slug, 'id' => $ignorar_id ?? 0]);
        return $sql->fetchColumn() > 0;
    }

    public function salvar(array $dados, ?int $id = null): int
    {
        $campos = [
            'slug' => $dados['slug'],
            'titulo' => $dados['titulo'],
            'resumo' => $dados['resumo'],
            'conteudo' => $dados['conteudo'],
            'emoji' => $dados['emoji'] ?: '📚',
            'autor_id' => $dados['autor_id'] ?: null,
            'publicado_em' => $dados['publicado_em'],
        ];

        if ($id === null) {
            $sql = $this->pdo->prepare(
                'INSERT INTO posts (slug, titulo, resumo, conteudo, emoji, autor_id, publicado_em)
                 VALUES (:slug, :titulo, :resumo, :conteudo, :emoji, :autor_id, :publicado_em)'
            );
            $sql->execute($campos);
            return (int) $this->pdo->lastInsertId();
        }

        $campos['id'] = $id;
        $sql = $this->pdo->prepare(
            'UPDATE posts SET slug = :slug, titulo = :titulo, resumo = :resumo, conteudo = :conteudo,
                    emoji = :emoji, autor_id = :autor_id, publicado_em = :publicado_em
             WHERE id = :id'
        );
        $sql->execute($campos);
        return $id;
    }

    // Os comentários do post são apagados junto (ON DELETE CASCADE no schema).
    // Devolve true se apagou (false = o post não existia).
    public function excluir(int $id): bool
    {
        $sql = $this->pdo->prepare('DELETE FROM posts WHERE id = :id');
        $sql->execute(['id' => $id]);
        return $sql->rowCount() > 0;
    }

    public function contar(): int
    {
        return (int) $this->pdo->query('SELECT COUNT(*) FROM posts')->fetchColumn();
    }
}
