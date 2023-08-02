<?php

namespace App\Support\Enums;

enum UserEnum: string
{
    const GENERO_MASCULINO = 'Masculino';
    const GENERO_FEMININO = 'Feminino';
    const GENERO_OUTRO = 'Outro';
    const E_ADMIN = 'true';
    const NAO_E_ADMIN = 'false';
}
