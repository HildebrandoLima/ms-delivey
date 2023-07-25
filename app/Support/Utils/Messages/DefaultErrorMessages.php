<?php

namespace App\Support\Utils\Messages;

class DefaultErrorMessages
{
    public const VALIDATION_FAILURE = "Informe os dados corretamente.";
    public const DATABASE_CONNECTION_ERROR = "Erro de conexão com o banco de dados.";
    public const DATABASE_QUERY_ERROR = "Erro durante a operação ao banco de dados.";
    public const INTERNAL_SERVER_ERROR = "Ocorreu um erro no processamento da sua solicitação. Tente novamente dentro de alguns minutos. Se o serviço continuar sem funcionar, entre em contato com o suporte.";
    public const FIELD_MUST_BE_INTEGER = "Esse campo deve ser do tipo inteiro.";
    public const FIELD_MUST_BE_STRINGER = "Esse campo deve ser do tipo string.";
    public const FIELD_MUST_BE_DECIMAL = "Esse campo deve ser do tipo float.";
    public const FIELD_MUST_BE_ARRAY = "Esse campo deve ser do tipo array.";
    public const FIELD_MUST_BE_BOOLEAN = "Esse campo deve ser do tipo boleano.";
    public const REQUIRED_FIELD = "Campo obrigatório.";
    public const NOT_EMPTY_FIELD = "Esse campo não pode ser vazio.";
    public const INVALID_DATE = "Data inválida.";
    public const INVALID_DATETIME = "Hora inválida.";
    public const MIN_CHARACTERS = "Esse campo não tem a quantidade mínima de caracteres.";
    public const MAX_CHARACTERS = "Esse campo excedeu a quantidade de caracteres.";
    public const INVALID_EMAIL = "Email inválido.";
    public const INVALID_PASSWORD = "Senha inválida.";
    public const NOT_FOUND = "Registro não encontrado.";
    public const ALREADY_EXISTING = "Registro já existente.";
    public const UNAUTHORIZED_MESSAGE = "Acesso não autorizado.";
    public const PERMISSION_MESSAGE = "Permissão negada.";
}
