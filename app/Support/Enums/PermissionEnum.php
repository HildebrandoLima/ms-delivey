<?php

namespace App\Support\Enums;

enum PermissionEnum: string
{
    const CRIAR_CATEGORIA = 'CRIAR_CATEGORIA';
    const CRIAR_FORNECEDOR = 'CRIAR_FORNECEDOR';
    const CRIAR_PAGAMENTO = 'CRIAR_PAGAMENTO';
    const CRIAR_PEDIDO = 'CRIAR_PEDIDO';
    const CRIAR_PRODUTO = 'CRIAR_PRODUTO';
    const EDITAR_CATEGORIA = 'EDITAR_CATEGORIA';
    const EDITAR_ENDERECO = 'EDITAR_ENDERECO';
    const EDITAR_FORNECEDOR = 'EDITAR_FORNECEDOR';
    const EDITAR_PRODUTO = 'EDITAR_PRODUTO';
    const EDITAR_TELEFONE = 'EDITAR_TELEFONE';
    const EDITAR_USUARIO = 'EDITAR_USUARIO';
    const LISTAR_CATEGORIAS = 'LISTAR_CATEGORIAS';
    const LISTAR_FORNECEDORES = 'LISTAR_FORNECEDORES';
    const LISTAR_PEDIDOS = 'LISTAR_PEDIDOS';
    const LISTAR_PRODUTOS = 'LISTAR_PRODUTOS';
    const LISTAR_USUARIOS = 'LISTAR_USUARIOS';
    const LISTAR_DETALHES_CATEGORIA = 'LISTAR_DETALHES_CATEGORIA';
    const LISTAR_DETALHES_FORNECEDOR = 'LISTAR_DETALHES_FORNECEDOR';
    const LISTAR_DETALHES_PEDIDO = 'LISTAR_DETALHES_PEDIDO';
    const LISTAR_DETALHES_PRODUTO = 'LISTAR_DETALHES_PRODUTO';
    const LISTAR_DETALHES_USUARIO = 'LISTAR_DETALHES_USUARIO';
}
