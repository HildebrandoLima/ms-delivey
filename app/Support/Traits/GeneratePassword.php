<?php

namespace App\Support\Traits;

use Illuminate\Support\Str;

trait GeneratePassword
{
    public function generatePassword(): string
    {
        $caracter = array('$', '*', '&', '@', '#');
        $rand_keys = array_rand($caracter);
        $password = rand(0, 100) . Str::random(10) . $caracter[$rand_keys];
        return $password;
    }
}
