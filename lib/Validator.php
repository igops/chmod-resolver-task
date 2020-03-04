<?php


namespace Kugaudo\Chmod;


class Validator
{
    /**
     * @param int $base
     * @return bool
     */
    public static function isBaseValid(int $base): bool
    {
        return ($base < 37 && $base > 0);
    }

    /**
     * @param string $digit
     * @return false|int
     */
    public static function isDigitValid(string $digit)
    {
        return (bool) preg_match('/^[A-Z0-9]+$/i', $digit);
    }

    /**
     * @param string[] $arr
     * @param int $base
     * @return bool
     */
    public static function validateDigits($arr, $base): bool
    {
        return !self::contains($arr, self::basePredicate($base));
    }

    /**
     * @param string[] $arr
     * @param callable $predicate
     * @return bool
     */
    public static function contains($arr, $predicate){
        foreach($arr as $v) {
            if ($predicate($v)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param $base
     * @return \Closure
     */
    private static function basePredicate($base): \Closure
    {
        return function (string $value) use ($base) {
            return UniversalExtractor::indexOf($value) >= $base;
        };
    }
}
