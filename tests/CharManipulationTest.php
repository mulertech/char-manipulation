<?php

namespace MulerTech\CharManipulation\Tests;

use MulerTech\CharManipulation\CharManipulation;
use PHPUnit\Framework\TestCase;

class CharManipulationTest extends TestCase
{
    public function testSpecialCharsTrim(): void
    {
        static::assertEquals(
            'Test without html balise',
            CharManipulation::specialCharsTrim('<script\>Test without html balise</script>')
        );
        static::assertEquals('Test trim', CharManipulation::specialCharsTrim(' Test trim '));
        static::assertEquals(
            ['Test &quot;trim&quot;', 'with', 'array', 'and', 'null', null],
            CharManipulation::specialCharsTrim(
                [' Test "trim"', '<script\>with</script>', ' array  ', ' and', 'null ', null]
            )
        );
    }

    public function testSpecialCharsTrimAndDecode(): void
    {
        $test = CharManipulation::specialCharsTrim("'test single quote");
        static::assertEquals('&#039;test single quote', $test);
        CharManipulation::specialCharsDecode($test);
        static::assertEquals("'test single quote", $test);
    }

    public function testSpecialCharsDecodeString(): void
    {
        $test = '&#039;test single quote';
        CharManipulation::specialCharsDecode($test);
        static::assertEquals("'test single quote", $test);
    }

    public function testSpecialCharsDecodeNullValue(): void
    {
        $test = null;
        CharManipulation::specialCharsDecode($test);
        static::assertEquals(null, $test);
    }

    public function testSpecialCharsDecodeSimpleArray(): void
    {
        $test = ['&#039;test single quote', 'test quote&quot;', 'with null', null];
        CharManipulation::specialCharsDecode($test);
        static::assertEquals(["'test single quote", 'test quote"', 'with null', null], $test);
    }

    public function testSpecialCharsDecodeMultiDimensionalArray(): void
    {
        $test = [
            'test1' => '&#039;test single quote',
            'test2' => 'test quote&quot;',
            'test3' => 'with null',
            'test4' => null,
            'test5' => [
                'test5a' => "&#039;test single quote",
                'test5b' => 'test quote&quot;',
                'test5c' => 'with null',
                'test5d' => null
            ]
        ];
        CharManipulation::specialCharsDecode($test);
        static::assertEquals(
            [
                'test1' => "'test single quote",
                'test2' => 'test quote"',
                'test3' => 'with null',
                'test4' => null,
                'test5' => [
                    'test5a' => "'test single quote",
                    'test5b' => 'test quote"',
                    'test5c' => 'with null',
                    'test5d' => null
                ]
            ],
            $test
        );
    }
}
