<?php

namespace App\Support\Enums;

enum UserEnum: string
{
    case GENERO_MASCULINO = 'Masculino';
    case GENERO_FEMININO = 'Feminino';
    case GENERO_OUTRO = 'Outro';
    case E_ADMIN = 'true';
    case NAO_E_ADMIN = 'false';
}
