<?php


namespace Kugaudo\Chmod;


class UniversalExtractor
{
    public const DIGIT_ERROR = 'digit contains invalid chars';
    public const BASE_ERROR = 'base contains invalid chars';
    public const DIGIT_OUT_OF_BASE = 'digit does not exists in given base';

    /** @var array  */
    private static $digitMap = [
        '0' => 0,  '1' => 1,  '2' => 2,  '3' => 3,  '4' => 4,  '5' => 5,  '6' => 6,
        '7' => 7,  '8' => 8,  '9' => 9,  'A' => 10, 'B' => 11, 'C' => 12, 'D' => 13,
        'E' => 14, 'F' => 15, 'G' => 16, 'H' => 17, 'I' => 18, 'J' => 19, 'K' => 20,
        'L' => 21, 'M' => 22, 'N' => 23, 'O' => 24, 'P' => 25, 'Q' => 26, 'R' => 27,
        'S' => 28, 'T' => 29, 'U' => 30, 'V' => 31, 'W' => 32, 'X' => 33, 'Y' => 34,
        'Z' => 35
    ];

    public function extract(int $base, int $value, int $digit)
    {
        $shifted = (int) ($value / pow($base, $digit));
        return $shifted % $base;
    }

    public function decToBin(int $decimal): string
    {
        if ($decimal === 0) {
            return '0';
        }
        $resultBin = [];
        while ($decimal > 0) {
            $remainder = $decimal % 2;
            $resultBin[] = $remainder;
            $decimal = ($decimal - $remainder) / 2;
        }

        return join('', array_reverse($resultBin));
    }

    /**
     * @param string $value
     * @return int
     */
    public static function indexOf(string $value)
    {
        return self::$digitMap[strtoupper($value)];
    }

    /**
     * @param string $digit
     * @param int $base
     * @return int|string
     */
    public function anyToDec(string $digit, int $base)
    {
        if (!Validator::isBaseValid($base)) {
            return self::BASE_ERROR;
        }
        if (!Validator::isDigitValid($digit)) {
            return self::DIGIT_ERROR;
        }
        if (!Validator::validateDigits(str_split($digit), $base)) {
            return self::DIGIT_OUT_OF_BASE;
        }

        $result = 0;
        $digitLastKey = strlen($digit) - 1;

        for ($i = $digitLastKey; $i > -1; $i--) {
            $result += self::$digitMap[$digit[$i]] * pow($base, $digitLastKey - $i);
        }
        return $result;
    }
}
