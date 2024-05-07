<?php

namespace App\Domains\Traits\GenerateData;

use Illuminate\Support\Str;

trait GeneratePassword
{
    public function generatePassword(): string
    {
        $caracter = array('$', '*', '&', '@', '#');
        $rand_keys = array_rand($caracter);
        $password = Str::random(10) . rand(0, 100) . $caracter[$rand_keys];
        return $password;
    }
}
