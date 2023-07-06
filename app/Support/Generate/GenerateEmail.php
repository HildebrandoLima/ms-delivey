<?php

namespace App\Support\Generate;

use Illuminate\Support\Str;

class GenerateEmail
{
    public static function generateEmail(): string
    {
        $dominio = array('@gmail.com', '@outlook.com', '@business.com.br');
        $rand_keys = array_rand($dominio);
        $email = Str::random(10) . $dominio[$rand_keys];
        return $email;
    }
}
