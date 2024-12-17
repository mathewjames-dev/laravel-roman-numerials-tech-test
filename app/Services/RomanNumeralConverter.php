<?php

namespace App\Services;

class RomanNumeralConverter implements IntegerConverterInterface
{
    public function convertInteger(int $integer): string
    {
        $integerMapping = [
            1000 => 'M',
            900 => 'CM',
            500 => 'D',
            400 => 'CD',
            100 => 'C',
            90 => 'XC',
            50 => 'L',
            40 => 'XL',
            10 => 'X',
            9 => 'IX',
            5 => 'V',
            4 => 'IV',
            1 => 'I'
        ];

        $romanNumeral = '';

        foreach ($integerMapping as $value => $roman) {
            while ($integer >= $value) {
                $romanNumeral .= $roman;
                $integer -= $value;
            }
        }

        return $romanNumeral;
    }
}
