<?php
declare(strict_types=1);

use Kugaudo\Chmod\ChmodResolver;
use PHPUnit\Framework\TestCase;


final class ChmodResolverTest extends TestCase
{
    private $chmodResolver;

    protected function setUp(): void
    {
        parent::setUp();
        $this->chmodResolver = new ChmodResolver();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        unset($this->chmodResolver);
    }

    public function test_whenOpIsZero_thenWhoCanNothing()
    {
        $this->assertEquals(false, $this->chmodResolver->of((int)'000', 'o', 'r')->matches());
        $this->assertEquals(false, $this->chmodResolver->of((int)'000', 'o', 'w')->matches());
        $this->assertEquals(false, $this->chmodResolver->of((int)'000', 'o', 'x')->matches());

        $this->assertEquals(false, $this->chmodResolver->of((int)'000', 'g', 'r')->matches());
        $this->assertEquals(false, $this->chmodResolver->of((int)'000', 'g', 'w')->matches());
        $this->assertEquals(false, $this->chmodResolver->of((int)'000', 'g', 'x')->matches());

        $this->assertEquals(false, $this->chmodResolver->of((int)'000', 'u', 'r')->matches());
        $this->assertEquals(false, $this->chmodResolver->of((int)'000', 'u', 'w')->matches());
        $this->assertEquals(false, $this->chmodResolver->of((int)'000', 'u', 'x')->matches());
    }

    public function test_whenOpIsOne_thenWhoCanExecuteOnly()
    {
        $this->assertEquals(false, $this->chmodResolver->of((int)'001', 'o', 'r')->matches());
        $this->assertEquals(false, $this->chmodResolver->of((int)'001', 'o', 'w')->matches());
        $this->assertEquals(true,  $this->chmodResolver->of((int)'001', 'o', 'x')->matches());

        $this->assertEquals(false, $this->chmodResolver->of((int)'010', 'g', 'r')->matches());
        $this->assertEquals(false, $this->chmodResolver->of((int)'010', 'g', 'w')->matches());
        $this->assertEquals(true,  $this->chmodResolver->of((int)'010', 'g', 'x')->matches());

        $this->assertEquals(false, $this->chmodResolver->of((int)'100', 'u', 'r')->matches());
        $this->assertEquals(false, $this->chmodResolver->of((int)'100', 'u', 'w')->matches());
        $this->assertEquals(true,  $this->chmodResolver->of((int)'100', 'u', 'x')->matches());
    }

    public function test_whenOpIsTwo_thenWhoCanWriteOnly()
    {
        $this->assertEquals(false, $this->chmodResolver->of((int)'002', 'o', 'r')->matches());
        $this->assertEquals(true,  $this->chmodResolver->of((int)'002', 'o', 'w')->matches());
        $this->assertEquals(false, $this->chmodResolver->of((int)'002', 'o', 'x')->matches());

        $this->assertEquals(false, $this->chmodResolver->of((int)'020', 'g', 'r')->matches());
        $this->assertEquals(true,  $this->chmodResolver->of((int)'020', 'g', 'w')->matches());
        $this->assertEquals(false, $this->chmodResolver->of((int)'020', 'g', 'x')->matches());

        $this->assertEquals(false, $this->chmodResolver->of((int)'200', 'u', 'r')->matches());
        $this->assertEquals(true,  $this->chmodResolver->of((int)'200', 'u', 'w')->matches());
        $this->assertEquals(false, $this->chmodResolver->of((int)'200', 'u', 'x')->matches());
    }

    public function test_whenOpIsThree_thenWhoCanWriteAndExecuteOnly()
    {
        $this->assertEquals(false, $this->chmodResolver->of((int)'003', 'o', 'r')->matches());
        $this->assertEquals(true,  $this->chmodResolver->of((int)'003', 'o', 'w')->matches());
        $this->assertEquals(true,  $this->chmodResolver->of((int)'003', 'o', 'x')->matches());

        $this->assertEquals(false, $this->chmodResolver->of((int)'030', 'g', 'r')->matches());
        $this->assertEquals(true,  $this->chmodResolver->of((int)'030', 'g', 'w')->matches());
        $this->assertEquals(true,  $this->chmodResolver->of((int)'030', 'g', 'x')->matches());

        $this->assertEquals(false, $this->chmodResolver->of((int)'300', 'u', 'r')->matches());
        $this->assertEquals(true,  $this->chmodResolver->of((int)'300', 'u', 'w')->matches());
        $this->assertEquals(true,  $this->chmodResolver->of((int)'300', 'u', 'x')->matches());
    }

    public function test_whenOpIsFour_thenWhoCanReadOnly()
    {
        $this->assertEquals(true,  $this->chmodResolver->of((int)'004', 'o', 'r')->matches());
        $this->assertEquals(false, $this->chmodResolver->of((int)'004', 'o', 'w')->matches());
        $this->assertEquals(false, $this->chmodResolver->of((int)'004', 'o', 'x')->matches());

        $this->assertEquals(true,  $this->chmodResolver->of((int)'040', 'g', 'r')->matches());
        $this->assertEquals(false, $this->chmodResolver->of((int)'040', 'g', 'w')->matches());
        $this->assertEquals(false, $this->chmodResolver->of((int)'040', 'g', 'x')->matches());

        $this->assertEquals(true,  $this->chmodResolver->of((int)'400', 'u', 'r')->matches());
        $this->assertEquals(false, $this->chmodResolver->of((int)'400', 'u', 'w')->matches());
        $this->assertEquals(false, $this->chmodResolver->of((int)'400', 'u', 'x')->matches());
    }

    public function test_whenOpIsFive_thenWhoCanReadAndExecuteOnly()
    {
        $this->assertEquals(true,  $this->chmodResolver->of((int)'005', 'o', 'r')->matches());
        $this->assertEquals(false, $this->chmodResolver->of((int)'005', 'o', 'w')->matches());
        $this->assertEquals(true,  $this->chmodResolver->of((int)'005', 'o', 'x')->matches());

        $this->assertEquals(true,  $this->chmodResolver->of((int)'050', 'g', 'r')->matches());
        $this->assertEquals(false, $this->chmodResolver->of((int)'050', 'g', 'w')->matches());
        $this->assertEquals(true,  $this->chmodResolver->of((int)'050', 'g', 'x')->matches());

        $this->assertEquals(true,  $this->chmodResolver->of((int)'500', 'u', 'r')->matches());
        $this->assertEquals(false, $this->chmodResolver->of((int)'500', 'u', 'w')->matches());
        $this->assertEquals(true,  $this->chmodResolver->of((int)'500', 'u', 'x')->matches());
    }

    public function test_whenOpIsSix_thenWhoCanReadAndWriteOnly()
    {
        $this->assertEquals(true,  $this->chmodResolver->of((int)'006', 'o', 'r')->matches());
        $this->assertEquals(true,  $this->chmodResolver->of((int)'006', 'o', 'w')->matches());
        $this->assertEquals(false, $this->chmodResolver->of((int)'006', 'o', 'x')->matches());

        $this->assertEquals(true,  $this->chmodResolver->of((int)'060', 'g', 'r')->matches());
        $this->assertEquals(true,  $this->chmodResolver->of((int)'060', 'g', 'w')->matches());
        $this->assertEquals(false, $this->chmodResolver->of((int)'060', 'g', 'x')->matches());

        $this->assertEquals(true,  $this->chmodResolver->of((int)'600', 'u', 'r')->matches());
        $this->assertEquals(true,  $this->chmodResolver->of((int)'600', 'u', 'w')->matches());
        $this->assertEquals(false, $this->chmodResolver->of((int)'600', 'u', 'x')->matches());
    }

    public function test_whenOpIsSeven_thenWhoCanDoEverything()
    {
        $this->assertEquals(true, $this->chmodResolver->of((int)'007', 'o', 'r')->matches());
        $this->assertEquals(true, $this->chmodResolver->of((int)'007', 'o', 'w')->matches());
        $this->assertEquals(true, $this->chmodResolver->of((int)'007', 'o', 'x')->matches());

        $this->assertEquals(true, $this->chmodResolver->of((int)'070', 'g', 'r')->matches());
        $this->assertEquals(true, $this->chmodResolver->of((int)'070', 'g', 'w')->matches());
        $this->assertEquals(true, $this->chmodResolver->of((int)'070', 'g', 'x')->matches());

        $this->assertEquals(true, $this->chmodResolver->of((int)'700', 'u', 'r')->matches());
        $this->assertEquals(true, $this->chmodResolver->of((int)'700', 'u', 'w')->matches());
        $this->assertEquals(true, $this->chmodResolver->of((int)'700', 'u', 'x')->matches());
    }
}
