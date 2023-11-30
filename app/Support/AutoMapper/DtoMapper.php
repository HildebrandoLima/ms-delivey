<?php

namespace App\Support\AutoMapper;

class DtoMapper
{
    public static function map(array $data, string $dtoClass): object
    {
        $dto = new $dtoClass();

        foreach ($data as $key => $value):
            $property = self::convertSnakeToCamel($key);
            if (property_exists($dtoClass, $property)):
                $dto->$property = $value;
            endif;
        endforeach;

        if (method_exists($dtoClass, 'customizeMapping')):
            $dto->customizeMapping($data);
        endif;

        return $dto;
    }

    private static function convertSnakeToCamel(string $input): string
    {
        return lcfirst(str_replace('_', '', ucwords($input, '_')));
    }
}
