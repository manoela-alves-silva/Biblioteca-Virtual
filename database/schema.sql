-- =====================================================================
-- ESTRUTURA DO BANCO DE DADOS (SQLite)
-- Cada "CREATE TABLE" cria uma tabela, como se fosse uma planilha.
-- Este arquivo é executado pelo database/instalar.php
-- =====================================================================

-- Apaga as tabelas antigas (útil para recomeçar do zero).
-- A ordem importa: primeiro quem depende de outra tabela.
DROP TABLE IF EXISTS pedido_itens;  -- (tabelas da versão antiga, que tinha loja)
DROP TABLE IF EXISTS pedidos;
DROP TABLE IF EXISTS comentarios;
DROP TABLE IF EXISTS posts;
DROP TABLE IF EXISTS livros;
DROP TABLE IF EXISTS autores;
DROP TABLE IF EXISTS usuarios;

-- Escritoras e escritores
CREATE TABLE autores (
    id               INTEGER PRIMARY KEY AUTOINCREMENT,
    slug             TEXT    NOT NULL UNIQUE,      -- nome para a URL: "bell-hooks"
    nome             TEXT    NOT NULL,
    nome_completo    TEXT,
    nascimento       INTEGER,                      -- ano
    falecimento      INTEGER,                      -- ano (vazio se está viva/vivo)
    local_nascimento TEXT,
    nacionalidade    TEXT    NOT NULL,
    foto             TEXT,                         -- nome do arquivo em public/img/autores
    foto_posicao     TEXT    NOT NULL DEFAULT 'center 25%', -- enquadramento da foto
    foto_credito     TEXT,
    cor              TEXT    NOT NULL DEFAULT '#FF6B57',
    resumo           TEXT    NOT NULL,
    biografia        TEXT    NOT NULL,             -- parágrafos separados por linha em branco
    citacao          TEXT,
    citacao_fonte    TEXT,                         -- de onde a citação foi tirada (livro, palestra...)
    citacao_url      TEXT,                         -- link onde dá para conferir a citação
    fonte_url        TEXT                          -- de onde tiramos as informações da biografia
);

-- Livros (cada livro pertence a UM autor -> chave estrangeira autor_id)
CREATE TABLE livros (
    id         INTEGER PRIMARY KEY AUTOINCREMENT,
    autor_id   INTEGER NOT NULL REFERENCES autores(id) ON DELETE RESTRICT,
    titulo     TEXT    NOT NULL,
    coautoria  TEXT,                                -- ex: "com Nei Lopes"
    ano        INTEGER,
    sinopse    TEXT    NOT NULL,
    cor        TEXT    NOT NULL DEFAULT '#FF6B57',  -- cor da capa
    destaque   INTEGER NOT NULL DEFAULT 0,          -- 1 = aparece na página inicial
    criado_em  TEXT    NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Posts do blog
CREATE TABLE posts (
    id            INTEGER PRIMARY KEY AUTOINCREMENT,
    slug          TEXT    NOT NULL UNIQUE,
    titulo        TEXT    NOT NULL,
    resumo        TEXT    NOT NULL,
    conteudo      TEXT    NOT NULL,
    emoji         TEXT    NOT NULL DEFAULT '📚',
    autor_id      INTEGER REFERENCES autores(id) ON DELETE SET NULL, -- sobre quem é o post
    publicado_em  TEXT    NOT NULL
);

-- Comentários dos posts (se o post for apagado, os comentários vão junto)
CREATE TABLE comentarios (
    id         INTEGER PRIMARY KEY AUTOINCREMENT,
    post_id    INTEGER NOT NULL REFERENCES posts(id) ON DELETE CASCADE,
    nome       TEXT    NOT NULL,
    texto      TEXT    NOT NULL,
    criado_em  TEXT    NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Quem pode entrar no painel de administração
CREATE TABLE usuarios (
    id          INTEGER PRIMARY KEY AUTOINCREMENT,
    nome        TEXT NOT NULL,
    email       TEXT NOT NULL UNIQUE,
    senha_hash  TEXT NOT NULL          -- NUNCA guardamos a senha pura!
);
