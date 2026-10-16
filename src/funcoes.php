<?php
// =====================================================================
// FUNÇÕES AJUDANTES
// Pequenas funções usadas em várias páginas.
// =====================================================================

// Protege o texto antes de mostrar na tela (evita que alguém injete
// código HTML/JavaScript, o famoso ataque XSS).
function e(?string $texto): string
{
    return htmlspecialchars($texto ?? '', ENT_QUOTES, 'UTF-8');
}

// "2026-10-10" -> "10/10/2026"
function data_br(string $data): string
{
    return date('d/m/Y', strtotime($data));
}

// Quebra um texto em parágrafos (separados por linha em branco).
function paragrafos(string $texto): array
{
    $partes = preg_split("/\R\s*\R/", trim($texto));
    return array_filter(array_map('trim', $partes));
}

// "Luiz Antonio Simas" -> "LS" (usado no avatar quando não há foto)
function iniciais(string $nome): string
{
    $palavras = explode(' ', trim($nome));
    $primeira = mb_substr($palavras[0], 0, 1);
    $ultima = count($palavras) > 1 ? mb_substr(end($palavras), 0, 1) : '';
    return mb_strtoupper($primeira . $ultima);
}

// "Conceição Evaristo" -> "conceicao-evaristo" (para URLs)
function gerar_slug(string $texto): string
{
    $texto = mb_strtolower(trim($texto));
    $texto = iconv('UTF-8', 'ASCII//TRANSLIT', $texto);
    $texto = preg_replace('/[^a-z0-9]+/', '-', $texto);
    return trim($texto, '-');
}

// "1952 – 2021", "1977" ou "" dependendo do que existe.
function periodo_de_vida(array $autor): string
{
    if (!$autor['nascimento']) {
        return '';
    }
    if ($autor['falecimento']) {
        return $autor['nascimento'] . ' – ' . $autor['falecimento'];
    }
    return 'nasceu em ' . $autor['nascimento'];
}

// Link para outra página da listagem, mantendo os filtros da URL.
function link_pagina(int $numero): string
{
    $parametros = $_GET;
    $parametros['pagina'] = $numero;
    return '?' . http_build_query($parametros);
}

// Endereço seguro para voltar depois de um formulário (só links do próprio site).
function url_de_volta(string $padrao = '/'): string
{
    $url = $_POST['voltar'] ?? '';
    if (str_starts_with($url, '/') && !str_starts_with($url, '//')) {
        return $url;
    }
    return $padrao;
}

// "https://pt.wikipedia.org/wiki/Nei_Lopes" -> "pt.wikipedia.org"
// (para mostrar de onde veio a informação sem exibir o link enorme)
function dominio(string $url): string
{
    return parse_url($url, PHP_URL_HOST) ?: $url;
}

// Manda o navegador para outra página e para o script.
function redirecionar(string $url): void
{
    header('Location: ' . $url);
    exit;
}

// Mostra a página 404 quando algo não existe.
function pagina_nao_encontrada(): void
{
    http_response_code(404);
    global $config, $favoritos;
    $titulo = 'Página não encontrada';
    $pagina = '';
    require RAIZ . '/views/layout/cabecalho.php';
    require RAIZ . '/views/404.php';
    require RAIZ . '/views/layout/rodape.php';
    exit;
}

// ---------------------------------------------------------------------
// MENSAGENS "FLASH": aparecem uma vez só, na próxima página.
// Ex: flash('sucesso', 'Livro salvo!'); redirecionar('livros.php');
// ---------------------------------------------------------------------
function flash(string $tipo, string $mensagem): void
{
    $_SESSION['flash'][] = ['tipo' => $tipo, 'mensagem' => $mensagem];
}

function pegar_flashes(): array
{
    $mensagens = $_SESSION['flash'] ?? [];
    unset($_SESSION['flash']);
    return $mensagens;
}

// ---------------------------------------------------------------------
// PROTEÇÃO CSRF
// Todo formulário POST leva um "código secreto" escondido.
// Assim outro site não consegue enviar formulários fingindo ser você.
// ---------------------------------------------------------------------
function csrf_token(): string
{
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}

function csrf_campo(): string
{
    return '<input type="hidden" name="csrf" value="' . csrf_token() . '">';
}

function verificar_csrf(): void
{
    if (!hash_equals(csrf_token(), $_POST['csrf'] ?? '')) {
        http_response_code(419);
        exit('Sessão expirada. Volte e tente de novo.');
    }
}

// Atalho: a requisição é um envio de formulário?
function eh_post(): bool
{
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}
