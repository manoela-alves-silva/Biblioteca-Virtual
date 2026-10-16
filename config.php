<?php
// =====================================================================
// CONFIGURAÇÕES DO SITE
// Tudo que pode mudar de um computador para outro fica aqui.
// =====================================================================

return [
    'nome_site' => 'Estante Aberta',

    // true  = mostra os erros do PHP na tela (bom para desenvolver no seu computador)
    // false = esconde os erros (OBRIGATÓRIO se um dia o site for publicado na internet,
    //         porque os erros podem mostrar detalhes do código para qualquer pessoa)
    'mostrar_erros' => true,

    // Caminho do arquivo do banco SQLite.
    // (Se um dia quiser usar MySQL, só a classe Banco precisa mudar.)
    'banco' => __DIR__ . '/database/banco.sqlite',

    // Quantos itens por página nas listagens.
    'livros_por_pagina' => 12,

    // Tamanho máximo da foto enviada no admin (em bytes): 2 MB.
    'tamanho_maximo_foto' => 2 * 1024 * 1024,
];
