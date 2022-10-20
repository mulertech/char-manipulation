<?php

namespace mtphp\CharManipulation;

/**
 * Class CharManipulation
 * @package mtphp\CharManipulation
 * @author Sébastien Muler
 */
class CharManipulation
{

    /**
     * @param $data
     * @return array|string
     */
    public static function specialCharsTrim($data)
    {
        if (is_array($data)) {
            array_walk_recursive(
                $data,
                static function (&$data) {
                    $data = self::specialCharsTrim($data);
                }
            );
            return $data;
        }

        if ($data !== null) {
            return trim(htmlspecialchars(strip_tags($data), ENT_QUOTES, 'UTF-8', false));
        }
        return null;
    }

    /**
     * Make the htmlspecialchars_decode for all the values of $data reference, array string or null values.
     * @param array|string $data
     */
    public static function specialCharsDecode(&$data): void
    {
        if (!is_array($data)) {
            if (!is_null($data)) {
                $data = htmlspecialchars_decode($data, ENT_QUOTES);
            }
            return;
        }

        array_walk(
            $data,
            static function (&$data) {
                self::specialCharsDecode($data);
            }
        );
    }

}
