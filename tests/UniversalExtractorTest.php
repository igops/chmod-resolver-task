<?php


use Kugaudo\Chmod\UniversalExtractor;
use PHPUnit\Framework\TestCase;

class UniversalExtractorTest extends TestCase
{
    private $universalExtractor;

    protected function setUp(): void
    {
        parent::setUp();
        $this->universalExtractor = new UniversalExtractor();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        unset($this->universalExtractor);
    }

    public function test_extract()
    {
        $this->assertEquals(0, $this->universalExtractor->extract(2, 0, 0));
        $this->assertEquals(1, $this->universalExtractor->extract(2, 10, 1));
        $this->assertEquals(0, $this->universalExtractor->extract(2, 11, 2));

        $this->assertEquals(3, $this->universalExtractor->extract(10, 113, 0));
        $this->assertEquals(1, $this->universalExtractor->extract(10, 113, 1));

        $this->assertEquals(0xF, $this->universalExtractor->extract(16, 0xAF, 0));
        $this->assertEquals(0xA, $this->universalExtractor->extract(16, 0xAF, 1));

    }

    public function test_decToBin()
    {
        $this->assertEquals('10011010010', $this->universalExtractor->decToBin(1234));
        $this->assertEquals('1', $this->universalExtractor->decToBin(1));
        $this->assertEquals('0', $this->universalExtractor->decToBin(0));
        $this->assertEquals('10', $this->universalExtractor->decToBin(2));
        $this->assertEquals('11', $this->universalExtractor->decToBin(3));
        $this->assertEquals('100', $this->universalExtractor->decToBin(4));
    }

    public function test_anyToDec()
    {
        $this->assertEquals(0, $this->universalExtractor->anyToDec('0', 2));
        $this->assertEquals(1, $this->universalExtractor->anyToDec('1', 2));

        $this->assertEquals(22, $this->universalExtractor->anyToDec('22', 10));
        $this->assertEquals(0, $this->universalExtractor->anyToDec('0', 10));

        $this->assertEquals(15, $this->universalExtractor->anyToDec('F', 16));
        $this->assertEquals(8, $this->universalExtractor->anyToDec('8', 16));
        $this->assertEquals(255, $this->universalExtractor->anyToDec('FF', 16));
        $this->assertEquals(161, $this->universalExtractor->anyToDec('A1', 16));

        $this->assertEquals(UniversalExtractor::DIGIT_OUT_OF_BASE, $this->universalExtractor->anyToDec('X1', 25));

        $this->assertEquals( UniversalExtractor::DIGIT_ERROR
            , $this->universalExtractor->anyToDec('!@#$', 2));

        $this->assertEquals( UniversalExtractor::BASE_ERROR
            , $this->universalExtractor->anyToDec('1234', 37));

    }

}
