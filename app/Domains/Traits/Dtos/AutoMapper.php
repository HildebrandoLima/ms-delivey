<?php

namespace App\Domains\Traits\Dtos;

trait AutoMapper
{
    public static function mapTo(array $data, string $dtoClass): object
    {
        $dto = new $dtoClass();

        foreach ($data as $key => $value) {
            $property = self::convertSnakeToCamel($key);

            if (property_exists($dtoClass, $property)) {
                if (is_null($dto->$property)) {
                    self::validateType($dto, $property, $value);
                }
                self::validateType($dto, $property, $value);
            }
        }

        if (method_exists($dtoClass, 'customizeMapping')) {
            $dto->customizeMapping($data);
        }

        return $dto;
    }

    private static function convertSnakeToCamel(string $input): string
    {
        return lcfirst(str_replace('_', '', ucwords($input, '_')));
    }

    private static function validateType(object $dto, string $property, mixed $value): void
    {
        switch (true) {
            case is_int($dto->$property):
                $dto->$property = $value ?? 0;
            break;
            case is_float($dto->$property):
                $dto->$property = $value ?? 0.0;
            break;
            case is_string($dto->$property):
                $dto->$property = $value ?? '';
            break;
            case is_array($dto->$property):
                $dto->$property = $value ?? [];
            break;
            case is_bool($dto->$property):
                $dto->$property = $value ?? false;
            break;
        }
    }
}
