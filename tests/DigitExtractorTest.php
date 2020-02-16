<?php
declare(strict_types=1);

use Kugaudo\Chmod\DigitExtractor;
use PHPUnit\Framework\TestCase;


final class DigitExtractorTest extends TestCase
{
    private $digitExtractor;

    protected function setUp(): void
    {
        parent::setUp();
        $this->digitExtractor = new DigitExtractor();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        unset($this->digitExtractor);
    }

    public function test_whenChangeOtherDigits_thenLookupDigitIsTheSame()
    {
        $this->assertEquals(1, $this->digitExtractor->get(121, 0));
        $this->assertEquals(1, $this->digitExtractor->get(341, 0));
        $this->assertEquals(1, $this->digitExtractor->get(561, 0));
        $this->assertEquals(1, $this->digitExtractor->get(781, 0));
        $this->assertEquals(1, $this->digitExtractor->get(901, 0));

        $this->assertEquals(2, $this->digitExtractor->get(122, 1));
        $this->assertEquals(2, $this->digitExtractor->get(324, 1));
        $this->assertEquals(2, $this->digitExtractor->get(526, 1));
        $this->assertEquals(2, $this->digitExtractor->get(728, 1));
        $this->assertEquals(2, $this->digitExtractor->get(920, 1));

        $this->assertEquals(3, $this->digitExtractor->get(312, 2));
        $this->assertEquals(3, $this->digitExtractor->get(334, 2));
        $this->assertEquals(3, $this->digitExtractor->get(356, 2));
        $this->assertEquals(3, $this->digitExtractor->get(378, 2));
        $this->assertEquals(3, $this->digitExtractor->get(390, 2));
    }
}
