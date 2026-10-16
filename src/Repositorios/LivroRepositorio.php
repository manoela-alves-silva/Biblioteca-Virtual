<?php
// =====================================================================
// LivroRepositorio: todas as consultas da tabela "livros".
// =====================================================================

class LivroRepositorio
{
    private PDO $pdo;

    // Todo SELECT de livro já traz junto o nome e o slug do autor (JOIN).
    private const SELECT_BASE =
        'SELECT l.*, a.nome AS autor_nome, a.slug AS autor_slug
         FROM livros l
         JOIN autores a ON a.id = l.autor_id';

    // Opções de ordenação permitidas. NUNCA coloque o que veio da URL
    // direto no SQL: escolhemos de uma lista fechada.
    public const ORDENS = [
        'titulo'   => ['rotulo' => 'Título (A–Z)',       'sql' => 'l.titulo COLLATE NOCASE ASC'],
        'autor'    => ['rotulo' => 'Autor (A–Z)',        'sql' => 'a.nome COLLATE NOCASE ASC, l.ano ASC'],
        'recentes' => ['rotulo' => 'Mais recentes',      'sql' => 'l.ano DESC'],
        'antigos'  => ['rotulo' => 'Clássicos primeiro', 'sql' => 'l.ano ASC'],
    ];

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // -----------------------------------------------------------------
    // Busca com filtros + paginação.
    // $filtros pode ter: busca, autor (slug), ordem
    // -----------------------------------------------------------------
    public function buscar(array $filtros, int $limite, int $pular = 0): array
    {
        [$where, $parametros] = $this->montarFiltros($filtros);

        $ordem = self::ORDENS[$filtros['ordem'] ?? ''] ?? self::ORDENS['titulo'];

        $sql = $this->pdo->prepare(
            self::SELECT_BASE . $where . ' ORDER BY ' . $ordem['sql'] . ' LIMIT :limite OFFSET :pular'
        );
        foreach ($parametros as $nome => $valor) {
            $sql->bindValue($nome, $valor);
        }
        $sql->bindValue('limite', $limite, PDO::PARAM_INT);
        $sql->bindValue('pular', $pular, PDO::PARAM_INT);
        $sql->execute();

        return $sql->fetchAll();
    }

    // Quantos livros existem com esses filtros (para a paginação).
    public function contar(array $filtros = []): int
    {
        [$where, $parametros] = $this->montarFiltros($filtros);

        $sql = $this->pdo->prepare('SELECT COUNT(*) FROM livros l JOIN autores a ON a.id = l.autor_id' . $where);
        $sql->execute($parametros);
        return (int) $sql->fetchColumn();
    }

    // Monta o "WHERE ..." de acordo com os filtros escolhidos.
    private function montarFiltros(array $filtros): array
    {
        $condicoes = [];
        $parametros = [];

        if (!empty($filtros['busca'])) {
            // Procura no título OU no nome do autor.
            $condicoes[] = '(l.titulo LIKE :busca OR a.nome LIKE :busca)';
            $parametros['busca'] = '%' . $filtros['busca'] . '%';
        }

        if (!empty($filtros['autor'])) {
            $condicoes[] = 'a.slug = :autor';
            $parametros['autor'] = $filtros['autor'];
        }

        $where = $condicoes ? ' WHERE ' . implode(' AND ', $condicoes) : '';
        return [$where, $parametros];
    }

    public function destaques(int $limite = 8): array
    {
        $sql = $this->pdo->prepare(self::SELECT_BASE . ' WHERE l.destaque = 1 ORDER BY RANDOM() LIMIT :limite');
        $sql->bindValue('limite', $limite, PDO::PARAM_INT);
        $sql->execute();
        return $sql->fetchAll();
    }

    public function doAutor(int $autor_id): array
    {
        $sql = $this->pdo->prepare(self::SELECT_BASE . ' WHERE l.autor_id = :id ORDER BY l.ano');
        $sql->execute(['id' => $autor_id]);
        return $sql->fetchAll();
    }

    // Outros livros do mesmo autor (para "você também pode gostar").
    public function relacionados(array $livro, int $limite = 4): array
    {
        $sql = $this->pdo->prepare(
            self::SELECT_BASE . ' WHERE l.autor_id = :autor AND l.id != :id ORDER BY RANDOM() LIMIT :limite'
        );
        $sql->bindValue('autor', $livro['autor_id'], PDO::PARAM_INT);
        $sql->bindValue('id', $livro['id'], PDO::PARAM_INT);
        $sql->bindValue('limite', $limite, PDO::PARAM_INT);
        $sql->execute();
        return $sql->fetchAll();
    }

    public function porId(int $id): ?array
    {
        $sql = $this->pdo->prepare(self::SELECT_BASE . ' WHERE l.id = :id');
        $sql->execute(['id' => $id]);
        return $sql->fetch() ?: null;
    }

    // Vários livros de uma vez (página de favoritos). Devolve [id => livro].
    public function porIds(array $ids): array
    {
        if (count($ids) == 0) {
            return [];
        }

        // Cria "?, ?, ?" com a quantidade certa de interrogações.
        $marcadores = implode(', ', array_fill(0, count($ids), '?'));
        $sql = $this->pdo->prepare(self::SELECT_BASE . " WHERE l.id IN ($marcadores)");
        $sql->execute(array_values($ids));

        $resultado = [];
        foreach ($sql->fetchAll() as $livro) {
            $resultado[$livro['id']] = $livro;
        }
        return $resultado;
    }

    public function salvar(array $dados, ?int $id = null): int
    {
        $campos = [
            'autor_id' => $dados['autor_id'],
            'titulo' => $dados['titulo'],
            'coautoria' => $dados['coautoria'] ?: null,
            'ano' => $dados['ano'] ?: null,
            'sinopse' => $dados['sinopse'],
            'cor' => $dados['cor'],
            'destaque' => $dados['destaque'] ? 1 : 0,
        ];

        if ($id === null) {
            $sql = $this->pdo->prepare(
                'INSERT INTO livros (autor_id, titulo, coautoria, ano, sinopse, cor, destaque)
                 VALUES (:autor_id, :titulo, :coautoria, :ano, :sinopse, :cor, :destaque)'
            );
            $sql->execute($campos);
            return (int) $this->pdo->lastInsertId();
        }

        $campos['id'] = $id;
        $sql = $this->pdo->prepare(
            'UPDATE livros SET autor_id = :autor_id, titulo = :titulo, coautoria = :coautoria, ano = :ano,
                    sinopse = :sinopse, cor = :cor, destaque = :destaque
             WHERE id = :id'
        );
        $sql->execute($campos);
        return $id;
    }

    // Devolve true se apagou. rowCount() = quantas linhas o DELETE apagou (0 = não existia).
    public function excluir(int $id): bool
    {
        $sql = $this->pdo->prepare('DELETE FROM livros WHERE id = :id');
        $sql->execute(['id' => $id]);
        return $sql->rowCount() > 0;
    }
}
