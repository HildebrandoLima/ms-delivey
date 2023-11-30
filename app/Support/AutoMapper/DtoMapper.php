<?php

namespace App\Support\AutoMapper;

class DtoMapper
{
    public static function map(array $data, string $dtoClass): object
    {
        $dto = new $dtoClass();

        foreach (get_class_vars($dtoClass) as $property => $defaultValue):
            $dto->$property = $data[$property] ?? $defaultValue;
        endforeach;

        foreach (get_object_vars($dto) as $property => $value):
            if (isset($data[$property])):
                $dto->$property = $data[$property];
            endif;
        endforeach;

        if (method_exists($dtoClass, 'customizeMapping')):
            $dto->customizeMapping($data);
        endif;

        return $dto;
    }
}
