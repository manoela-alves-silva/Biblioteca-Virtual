<?php
// =====================================================================
// Favoritos: a lista de livros que a pessoa marcou com ❤️.
// Fica guardada na SESSÃO, então dura enquanto o navegador estiver aberto.
// =====================================================================

class Favoritos
{
    public function __construct()
    {
        if (!isset($_SESSION['favoritos'])) {
            $_SESSION['favoritos'] = [];
        }
    }

    // Se já é favorito, tira. Se não é, coloca. Devolve o novo estado.
    public function alternar(int $livro_id): bool
    {
        if ($this->contem($livro_id)) {
            $_SESSION['favoritos'] = array_values(array_diff($_SESSION['favoritos'], [$livro_id]));
            return false;
        }
        $_SESSION['favoritos'][] = $livro_id;
        return true;
    }

    public function contem(int $livro_id): bool
    {
        return in_array($livro_id, $_SESSION['favoritos']);
    }

    public function ids(): array
    {
        return $_SESSION['favoritos'];
    }

    public function total(): int
    {
        return count($_SESSION['favoritos']);
    }
}
