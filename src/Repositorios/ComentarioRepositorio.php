<?php
// =====================================================================
// ComentarioRepositorio: comentários dos posts do blog.
// =====================================================================

class ComentarioRepositorio
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function doPost(int $post_id): array
    {
        $sql = $this->pdo->prepare('SELECT * FROM comentarios WHERE post_id = :id ORDER BY criado_em, id');
        $sql->execute(['id' => $post_id]);
        return $sql->fetchAll();
    }

    public function criar(int $post_id, string $nome, string $texto): void
    {
        $sql = $this->pdo->prepare('INSERT INTO comentarios (post_id, nome, texto) VALUES (:post_id, :nome, :texto)');
        $sql->execute(['post_id' => $post_id, 'nome' => $nome, 'texto' => $texto]);
    }

    // Para o admin: todos os comentários com o título do post.
    public function todos(): array
    {
        return $this->pdo->query(
            'SELECT c.*, p.titulo AS post_titulo, p.slug AS post_slug
             FROM comentarios c
             JOIN posts p ON p.id = c.post_id
             ORDER BY c.criado_em DESC, c.id DESC'
        )->fetchAll();
    }

    // Devolve true se apagou (false = o comentário não existia).
    public function excluir(int $id): bool
    {
        $sql = $this->pdo->prepare('DELETE FROM comentarios WHERE id = :id');
        $sql->execute(['id' => $id]);
        return $sql->rowCount() > 0;
    }

    public function contar(): int
    {
        return (int) $this->pdo->query('SELECT COUNT(*) FROM comentarios')->fetchColumn();
    }
}
