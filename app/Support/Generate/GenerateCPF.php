<?php

namespace App\Support\Generate;

class GenerateCPF
{
    public static function generateCPF(): string
    {
        $digits = [];

        for ($i = 0; $i < 9; $i++) {
            $digits[] = mt_rand(0, 9);
        }

        $digits[] = self::firstVerifierDigit($digits);
        $digits[] = self::secondVerifierDigit($digits);
        $cpf = implode('', $digits);
        $formattedcpf = substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9, 2);

        return $formattedcpf;
    }

    private static function firstVerifierDigit($digits): float
    {
        $sum = 0;

        for ($i = 11, $j = 0; $i >= 2; $i--) {
            $sum += $i * ($digits[$j++] ?? 0);
        }

        $rest = $sum * 10 % 11;
        if ($rest >= 10) $rest = 0;
        return $rest;
    }

    private static function secondVerifierDigit($digits): float
    {
        $sum = 0;

        for ($i = 11, $j = 0; $i >= 2; $i--) {
            $sum += $i * $digits[$j++];
        }

        $rest = $sum * 10 % 11;
        if ($rest >= 10) $rest = 0;
        return $rest;
    }
}
