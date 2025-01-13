<?php

namespace MulerTech\CharManipulation;

/**
 * Class CharManipulation
 * @package MulerTech\CharManipulation
 * @author Sébastien Muler
 */
class CharManipulation
{
    /**
     * @param array<int|string, mixed>|string|null $data
     * @return array<int|string, mixed>|string|null
     */
    public static function specialCharsTrim(array|string|null $data): array|string|null
    {
        if (is_array($data)) {
            array_walk_recursive($data, static function (&$value) {
                $value = self::specialCharsTrim($value);
            });
            return $data;
        }

        if (is_string($data)) {
            return trim(htmlspecialchars(strip_tags($data), ENT_QUOTES, 'UTF-8', false));
        }

        return $data;
    }

    /**
     * Make the htmlspecialchars_decode for all the values of $data reference, array string or null values.
     * @param array<int|string, mixed>|string|null $data
     */
    public static function specialCharsDecode(array|string|null &$data): void
    {
        if (is_array($data)) {
            array_walk_recursive($data, static function (&$value) {
                self::specialCharsDecode($value);
            });

            return;
        }

        if (!is_null($data)) {
            $data = htmlspecialchars_decode($data, ENT_QUOTES);
        }
    }
}
