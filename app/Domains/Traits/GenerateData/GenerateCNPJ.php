<?php

namespace App\Domains\Traits\GenerateData;

trait GenerateCNPJ
{
    public function generateCNPJ(): string
    {
        $cnpj = '';

        for ($i = 0; $i < 8; $i++) {
            $cnpj .= mt_rand(0, 9);
        }

        $cnpj .= '00';

        while (strlen($cnpj) < 12) {
            $cnpj = '0' . $cnpj;
        }

        $sum = 0;
        $weights = [5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];

        for ($i = 0; $i < 12; $i++) {
            $sum += $cnpj[$i] * $weights[$i];
        }

        $firstVerifier = ($sum % 11 < 2) ? 0 : 11 - ($sum % 11);
        $cnpj[12] = $firstVerifier;

        $sum = 0;
        array_unshift($weights, 6);

        for ($i = 0; $i < 13; $i++) {
            $sum += $cnpj[$i] * $weights[$i];
        }

        $secondVerifier = ($sum % 11 < 2) ? 0 : 11 - ($sum % 11);
        $cnpj[13] = $secondVerifier;

        $formattedCnpj = substr($cnpj, 0, 2) . '.' . substr($cnpj, 2, 3) . '.' . substr($cnpj, 5, 3) . '/' . substr($cnpj, 8, 4) . '-' . substr($cnpj, 12, 2);

        return $formattedCnpj;
    }
}
