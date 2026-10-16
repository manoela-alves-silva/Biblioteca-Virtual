<?php
// =====================================================================
// Upload: recebe a foto enviada no formulário do admin e salva em
// public/img/autores. Confere o tipo e o tamanho do arquivo antes!
// =====================================================================

class Upload
{
    // Tipos de imagem aceitos => extensão do arquivo
    private const TIPOS_ACEITOS = [
        'image/jpeg' => 'jpg',
        'image/png'  => 'png',
        'image/webp' => 'webp',
    ];

    // $arquivo é o $_FILES['foto']. Devolve o nome do arquivo salvo.
    public static function salvarFoto(array $arquivo, string $nome_base, int $tamanho_maximo): string
    {
        if ($arquivo['error'] !== UPLOAD_ERR_OK) {
            throw new RuntimeException('Não foi possível enviar a foto. Tente de novo.');
        }

        if ($arquivo['size'] > $tamanho_maximo) {
            throw new RuntimeException('A foto é muito grande. O máximo é ' . ($tamanho_maximo / 1024 / 1024) . ' MB.');
        }

        // Não confiamos na extensão do nome: olhamos o conteúdo real do arquivo.
        $tipo = (new finfo(FILEINFO_MIME_TYPE))->file($arquivo['tmp_name']);
        if (!isset(self::TIPOS_ACEITOS[$tipo])) {
            throw new RuntimeException('Envie uma imagem JPG, PNG ou WEBP.');
        }

        // Nome novo e seguro, ex: "luiz-antonio-simas-1729000000.jpg"
        $nome = gerar_slug($nome_base) . '-' . time() . '.' . self::TIPOS_ACEITOS[$tipo];
        $destino = RAIZ . '/public/img/autores/' . $nome;

        if (!move_uploaded_file($arquivo['tmp_name'], $destino)) {
            throw new RuntimeException('Erro ao salvar a foto no servidor.');
        }

        return $nome;
    }
}
