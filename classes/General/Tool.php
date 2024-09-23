<?php

declare(strict_types=1);

namespace General;

class Tool
{
    public static function removeEmptySubArrays(array $from): array
    {
        return array_filter($from, function ($item) {
            return is_array($item) === true && Verify::arrayIsEmpty($item) === false;
        });
    }

    public static function convertObjectArrayToArray(array $toConvert): array
    {
        $converted = [];

        foreach ($toConvert as $key => $value) {
            $item = $value;

            if (is_object($value) === true) {
                $item = self::convertObjectToArray($value);
            }

            $converted[$key] = $item;
        }

        return $converted;
    }

    public static function convertObjectToArray(object $toConvert): array
    {
        if (method_exists($toConvert, 'toArray') === true) {
            return $toConvert->toArray();
        }

        return json_decode(json_encode($toConvert), true);
    }

    public static function arrayWithSpecialFirstValue(array $values, mixed $firstValue = ''): array
    {
        return [-1 => ''] + $values;
    }

    public static function arrayWithDefinedKeysAndSpecialFirstValue(
        array $keys,
        array $values,
        mixed $initialKey = '-1',
        mixed $initialValue = '',
    ): array {
        try {
            $firstValueArray = [$initialKey => $initialValue];
            $returnArray = $firstValueArray + array_combine($keys, $values);
        } catch (\ValueError $error) {
            return [];
        }

        return $returnArray;
    }
}
