<?php
// =====================================================================
// Autenticacao: login e logout do painel de administração.
// =====================================================================

class Autenticacao
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function entrar(string $email, string $senha): bool
    {
        $sql = $this->pdo->prepare('SELECT * FROM usuarios WHERE email = :email');
        $sql->execute(['email' => $email]);
        $usuario = $sql->fetch();

        // password_verify compara a senha digitada com o hash salvo.
        if (!$usuario || !password_verify($senha, $usuario['senha_hash'])) {
            return false;
        }

        // Gera um novo id de sessão (proteção contra roubo de sessão).
        session_regenerate_id(true);
        $_SESSION['usuario'] = ['id' => $usuario['id'], 'nome' => $usuario['nome']];
        return true;
    }

    public function sair(): void
    {
        unset($_SESSION['usuario']);
        session_regenerate_id(true);
    }

    // Troca a senha de quem está logado. Confere a senha atual antes.
    public function trocarSenha(string $senha_atual, string $senha_nova): bool
    {
        $id = $_SESSION['usuario']['id'] ?? 0;

        $sql = $this->pdo->prepare('SELECT senha_hash FROM usuarios WHERE id = :id');
        $sql->execute(['id' => $id]);
        $hash = $sql->fetchColumn();

        if (!$hash || !password_verify($senha_atual, $hash)) {
            return false;
        }

        $sql = $this->pdo->prepare('UPDATE usuarios SET senha_hash = :hash WHERE id = :id');
        $sql->execute(['hash' => password_hash($senha_nova, PASSWORD_DEFAULT), 'id' => $id]);
        return true;
    }

    public function logado(): bool
    {
        return isset($_SESSION['usuario']);
    }

    public function usuario(): ?array
    {
        return $_SESSION['usuario'] ?? null;
    }

    // Coloque no topo das páginas do admin: quem não está logado volta pro login.
    public function exigirLogin(): void
    {
        if (!$this->logado()) {
            flash('erro', 'Faça login para acessar o painel.');
            redirecionar('/admin/login.php');
        }
    }
}
