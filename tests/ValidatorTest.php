<?php


use Kugaudo\Chmod\Validator;
use PHPUnit\Framework\TestCase;

class ValidatorTest extends TestCase
{
    public function test_isBaseValid()
    {
        $this->assertEquals(true, Validator::isBaseValid(1));
        $this->assertEquals(true, Validator::isBaseValid(36));

        $this->assertEquals(false, Validator::isBaseValid(0));
        $this->assertEquals(false, Validator::isBaseValid(-1));
        $this->assertEquals(false, Validator::isBaseValid(37));
    }

    public function test_isDigitValid()
    {
        $this->assertEquals(true, Validator::isDigitValid('a'));
        $this->assertEquals(true, Validator::isDigitValid('x1'));
        $this->assertEquals(true, Validator::isDigitValid('zz'));
        $this->assertEquals(true, Validator::isDigitValid('Y13'));
        $this->assertEquals(true, Validator::isDigitValid('2331'));

        $this->assertEquals(false, Validator::isDigitValid('!@#$%'));
        $this->assertEquals(false, Validator::isDigitValid('+'));
        $this->assertEquals(false, Validator::isDigitValid('1+1'));
    }

    public function test_validateDigits()
    {
        $this->assertEquals(true, Validator::validateDigits(['0', '1'], 2));
        $this->assertEquals(true, Validator::validateDigits(['0'], 2));
        $this->assertEquals(true, Validator::validateDigits(['f', '3'], 16));
        $this->assertEquals(true, Validator::validateDigits(['f', '3', 'a'], 16));

        $this->assertEquals(false, Validator::validateDigits(['2'], 2));
        $this->assertEquals(false, Validator::validateDigits(['h', 'g'], 16));
        $this->assertEquals(false, Validator::validateDigits(['x', 'y'], 16));
    }
}
