<?php
// =====================================================================
// BOOTSTRAP ("dar a partida")
// Toda página começa incluindo este arquivo. Ele:
//   1. carrega as configurações
//   2. carrega as classes e funções
//   3. inicia a sessão
//   4. conecta no banco (e instala, se for a primeira vez)
// =====================================================================

// Caminho da pasta principal do projeto (uma pasta acima de /src).
define('RAIZ', dirname(__DIR__));

$config = require RAIZ . '/config.php';

// Mostra os erros na tela só enquanto estamos desenvolvendo (veja o config.php).
error_reporting(E_ALL);
ini_set('display_errors', $config['mostrar_erros'] ? '1' : '0');

// Classes e funções.
// Em projetos maiores o Composer faz isso sozinho ("autoload"),
// mas aqui fazemos à mão para você ver o que está acontecendo.
require_once RAIZ . '/src/funcoes.php';
require_once RAIZ . '/src/Banco.php';
require_once RAIZ . '/src/Repositorios/AutorRepositorio.php';
require_once RAIZ . '/src/Repositorios/LivroRepositorio.php';
require_once RAIZ . '/src/Repositorios/PostRepositorio.php';
require_once RAIZ . '/src/Repositorios/ComentarioRepositorio.php';
require_once RAIZ . '/src/Favoritos.php';
require_once RAIZ . '/src/Autenticacao.php';
require_once RAIZ . '/src/Upload.php';
require_once RAIZ . '/database/instalar.php';

// A sessão guarda os favoritos e o login entre uma página e outra.
if (PHP_SAPI !== 'cli' && session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Se o arquivo do banco ainda não existe, cria e preenche.
$primeira_vez = !file_exists($config['banco']);
$pdo = Banco::conectar($config['banco']);

if ($primeira_vez) {
    instalar_banco($pdo);
}

// Objetos que as páginas vão usar.
$autores     = new AutorRepositorio($pdo);
$livros      = new LivroRepositorio($pdo);
$posts       = new PostRepositorio($pdo);
$comentarios = new ComentarioRepositorio($pdo);
$favoritos   = new Favoritos();
$auth        = new Autenticacao($pdo);
