<?php
// =====================================================================
// Banco: cria a conexão com o banco de dados usando PDO.
// PDO é a forma moderna (e segura) de falar com bancos no PHP.
// =====================================================================

class Banco
{
    public static function conectar(string $arquivo): PDO
    {
        $pdo = new PDO('sqlite:' . $arquivo);

        // Se der erro no SQL, o PHP avisa com uma exceção (em vez de ficar quieto).
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Os resultados vêm como array associativo: $livro['titulo'].
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        // No SQLite, as chaves estrangeiras precisam ser ligadas.
        $pdo->exec('PRAGMA foreign_keys = ON');

        return $pdo;
    }
}
