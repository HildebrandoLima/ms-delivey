<?php

namespace App\Domains\Traits\GenerateData;

use Illuminate\Support\Str;

trait GenerateEmail
{
    public function generateEmail(): string
    {
        $dominio = array('@gmail.com', '@outlook.com', '@business.com.br');
        $rand_keys = array_rand($dominio);
        $email = Str::random(10) . $dominio[$rand_keys];
        return $email;
    }
}
