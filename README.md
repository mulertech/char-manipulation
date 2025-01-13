# CharManipulation

___
[![Latest Version on Packagist](https://img.shields.io/packagist/v/mulertech/char-manipulation.svg?style=flat-square)](https://packagist.org/packages/mulertech/char-manipulation)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/mulertech/char-manipulation/tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/mulertech/char-manipulation/actions/workflows/tests.yml)
[![GitHub PHPStan Action Status](https://img.shields.io/github/actions/workflow/status/mulertech/char-manipulation/phpstan.yml?branch=main&label=phpstan&style=flat-square)](https://github.com/mulertech/char-manipulation/actions/workflows/phpstan.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/mulertech/char-manipulation.svg?style=flat-square)](https://packagist.org/packages/mulertech/char-manipulation)
[![Test Coverage](https://raw.githubusercontent.com/mulertech/char-manipulation/main/badge-coverage.svg)](https://packagist.org/packages/mulertech/char-manipulation)
___

This class manipulates characters

___

## Installation

###### _Two methods to install Application package with composer :_

1.

Add to your "**composer.json**" file into require section :

```
"mulertech/char-manipulation": "^1.0"
```

and run the command :

```
php composer.phar update
```

2.

Run the command :

```
php composer.phar require mulertech/char-manipulation "^1.0"
```

___

## Usage

<br>

###### _specialCharsTrim, trim and convert special characters to HTML entities :_

```
CharManipulation::specialCharsTrim(' Test trim ');

// 'Test trim'
```

```
CharManipulation::specialCharsTrim('<script\>Test without html balise</script>');

// 'Test without html balise'
```

```
CharManipulation::specialCharsTrim([' Test "trim"', '<script\>with</script>', ' array  ', ' and', 'null ', null]);

// ['Test &quot;trim&quot;', 'with', 'array', 'and', 'null', null]
```

<br>

###### _specialCharsDecode (decode chars into string or array by reference, no return) :_

```
$test = '&#039;test single quote';
CharManipulation::specialCharsDecode($test);

// echo $test;
// "'test single quote";
```

```
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

// echo $test;
// [
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
   ];
```
