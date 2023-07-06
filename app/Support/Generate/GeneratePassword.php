<?php

namespace App\Support\Generate;

use Illuminate\Support\Str;

class GeneratePassword
{
    public static function generatePassword(): string
    {
        $caracter = array('$', '*', '&', '@', '#');
        $rand_keys = array_rand($caracter);
        $password = rand(0, 100) . Str::random(10) . $caracter[$rand_keys];
        return $password;
    }
}
