<?php

namespace App\Support\Utils\Date;

class DateFormat {
    public function dateFormatDefault(array $arrayModel): array
    {
        $convertFormartDate = str_replace(".000000Z", "", $arrayModel);
        $arrayModel = str_replace("T", " ", $convertFormartDate);
        return $arrayModel;
    }
}
