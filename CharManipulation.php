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
     * @param $data
     * @return array|string|null
     */
    public static function specialCharsTrim($data)
    {
        if (is_array($data)) {
            array_walk_recursive(
                $data,
                static function (&$value) {
                    $value = self::specialCharsTrim($value);
                }
            );
            return $data;
        }

        if (is_string($data)) {
            return trim(htmlspecialchars(strip_tags($data), ENT_QUOTES, 'UTF-8', false));
        }
        
        return $data;
    }

    /**
     * Make the htmlspecialchars_decode for all the values of $data reference, array string or null values.
     * @param $data
     */
    public static function specialCharsDecode(&$data): void
    {
        if (is_array($data)) {
            foreach ($data as &$value) {
                self::specialCharsDecode($value);
            }
        } elseif (!is_null($data)) {
            $data = htmlspecialchars_decode($data, ENT_QUOTES);
        }
    }

}
