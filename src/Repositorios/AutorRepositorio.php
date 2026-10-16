<?php
// =====================================================================
// AutorRepositorio: todas as consultas da tabela "autores".
// Repare que usamos "prepare" + parâmetros (:slug) em vez de colocar
// a variável direto no SQL. Isso evita o ataque "SQL Injection".
// =====================================================================

class AutorRepositorio
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Todos os autores, com a quantidade de livros de cada um.
    public function todos(): array
    {
        return $this->pdo->query(
            'SELECT a.*, COUNT(l.id) AS total_livros
             FROM autores a
             LEFT JOIN livros l ON l.autor_id = a.id
             GROUP BY a.id
             ORDER BY a.nome COLLATE NOCASE'
        )->fetchAll();
    }

    // Só alguns autores, em ordem aleatória (para a página inicial).
    public function sorteados(int $quantidade): array
    {
        $sql = $this->pdo->prepare('SELECT * FROM autores WHERE foto IS NOT NULL ORDER BY RANDOM() LIMIT :qtd');
        $sql->bindValue('qtd', $quantidade, PDO::PARAM_INT);
        $sql->execute();
        return $sql->fetchAll();
    }

    public function porSlug(string $slug): ?array
    {
        $sql = $this->pdo->prepare('SELECT * FROM autores WHERE slug = :slug');
        $sql->execute(['slug' => $slug]);
        return $sql->fetch() ?: null; // fetch devolve false se não achar
    }

    public function porId(int $id): ?array
    {
        $sql = $this->pdo->prepare('SELECT * FROM autores WHERE id = :id');
        $sql->execute(['id' => $id]);
        return $sql->fetch() ?: null;
    }

    // Lista simples id => nome (para os <select> do admin).
    public function opcoes(): array
    {
        return $this->pdo->query('SELECT id, nome FROM autores ORDER BY nome COLLATE NOCASE')
            ->fetchAll(PDO::FETCH_KEY_PAIR);
    }

    public function slugEmUso(string $slug, ?int $ignorar_id = null): bool
    {
        $sql = $this->pdo->prepare('SELECT COUNT(*) FROM autores WHERE slug = :slug AND id != :id');
        $sql->execute(['slug' => $slug, 'id' => $ignorar_id ?? 0]);
        return $sql->fetchColumn() > 0;
    }

    // Cria (se $id for null) ou atualiza um autor. Devolve o id.
    public function salvar(array $dados, ?int $id = null): int
    {
        $campos = [
            'slug' => $dados['slug'],
            'nome' => $dados['nome'],
            'nome_completo' => $dados['nome_completo'] ?: null,
            'nascimento' => $dados['nascimento'] ?: null,
            'falecimento' => $dados['falecimento'] ?: null,
            'local_nascimento' => $dados['local_nascimento'] ?: null,
            'nacionalidade' => $dados['nacionalidade'],
            'foto' => $dados['foto'] ?: null,
            'foto_posicao' => $dados['foto_posicao'] ?: 'center 25%',
            'foto_credito' => $dados['foto_credito'] ?: null,
            'cor' => $dados['cor'],
            'resumo' => $dados['resumo'],
            'biografia' => $dados['biografia'],
            'citacao' => $dados['citacao'] ?: null,
            'citacao_fonte' => $dados['citacao_fonte'] ?: null,
            'citacao_url' => $dados['citacao_url'] ?: null,
            'fonte_url' => $dados['fonte_url'] ?: null,
        ];

        if ($id === null) {
            $sql = $this->pdo->prepare(
                'INSERT INTO autores (slug, nome, nome_completo, nascimento, falecimento, local_nascimento, nacionalidade,
                                      foto, foto_posicao, foto_credito, cor, resumo, biografia,
                                      citacao, citacao_fonte, citacao_url, fonte_url)
                 VALUES (:slug, :nome, :nome_completo, :nascimento, :falecimento, :local_nascimento, :nacionalidade,
                         :foto, :foto_posicao, :foto_credito, :cor, :resumo, :biografia,
                         :citacao, :citacao_fonte, :citacao_url, :fonte_url)'
            );
            $sql->execute($campos);
            return (int) $this->pdo->lastInsertId();
        }

        $campos['id'] = $id;
        $sql = $this->pdo->prepare(
            'UPDATE autores SET slug = :slug, nome = :nome, nome_completo = :nome_completo, nascimento = :nascimento,
                    falecimento = :falecimento, local_nascimento = :local_nascimento, nacionalidade = :nacionalidade,
                    foto = :foto, foto_posicao = :foto_posicao, foto_credito = :foto_credito, cor = :cor,
                    resumo = :resumo, biografia = :biografia, citacao = :citacao,
                    citacao_fonte = :citacao_fonte, citacao_url = :citacao_url, fonte_url = :fonte_url
             WHERE id = :id'
        );
        $sql->execute($campos);
        return $id;
    }

    // Só deixa excluir se o autor não tiver livros.
    public function excluir(int $id): bool
    {
        $sql = $this->pdo->prepare('SELECT COUNT(*) FROM livros WHERE autor_id = :id');
        $sql->execute(['id' => $id]);
        if ($sql->fetchColumn() > 0) {
            return false;
        }

        $sql = $this->pdo->prepare('DELETE FROM autores WHERE id = :id');
        $sql->execute(['id' => $id]);
        return true;
    }

    // Para o painel: quem ainda está sem foto ou sem fonte.
    public function pendentes(): array
    {
        return $this->pdo->query(
            'SELECT * FROM autores WHERE foto IS NULL OR fonte_url IS NULL ORDER BY nome COLLATE NOCASE'
        )->fetchAll();
    }

    public function contar(): int
    {
        return (int) $this->pdo->query('SELECT COUNT(*) FROM autores')->fetchColumn();
    }
}
