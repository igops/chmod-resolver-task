<?php
declare(strict_types=1);

use Kugaudo\Chmod\BitExtractor;
use PHPUnit\Framework\TestCase;


final class BitExtractorTest extends TestCase
{
    private $bitExtractor;

    protected function setUp(): void
    {
        parent::setUp();
        $this->bitExtractor = new BitExtractor();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        unset($this->bitExtractor);
    }

    public function test_whenExtractBit_thenReturnIt()
    {
        $this->assertEquals(0, $this->bitExtractor->get(0, 0));

        $this->assertEquals(1, $this->bitExtractor->get(1, 0));

        $this->assertEquals(0, $this->bitExtractor->get(2, 0));
        $this->assertEquals(1, $this->bitExtractor->get(2, 1));

        $this->assertEquals(1, $this->bitExtractor->get(3, 0));
        $this->assertEquals(1, $this->bitExtractor->get(3, 1));

        $this->assertEquals(0, $this->bitExtractor->get(4, 0));
        $this->assertEquals(0, $this->bitExtractor->get(4, 1));
        $this->assertEquals(1, $this->bitExtractor->get(4, 2));

        $this->assertEquals(1, $this->bitExtractor->get(5, 0));
        $this->assertEquals(0, $this->bitExtractor->get(5, 1));
        $this->assertEquals(1, $this->bitExtractor->get(5, 2));

        $this->assertEquals(0, $this->bitExtractor->get(6, 0));
        $this->assertEquals(1, $this->bitExtractor->get(6, 1));
        $this->assertEquals(1, $this->bitExtractor->get(6, 2));

        $this->assertEquals(1, $this->bitExtractor->get(7, 0));
        $this->assertEquals(1, $this->bitExtractor->get(7, 1));
        $this->assertEquals(1, $this->bitExtractor->get(7, 2));
    }
}
