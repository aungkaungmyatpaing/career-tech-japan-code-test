<?php

namespace Tests\Unit;

use App\Services\InternetServiceProvider\MptInvoiceCalculator;
use PHPUnit\Framework\TestCase;

class MptInvoiceCalculatorTest extends TestCase
{
    /** @test */
    public function it_calculates_total_amount_for_mpt()
    {
        $calculator = new MptInvoiceCalculator();
        $calculator->setMonth(3); // For example, 3 months

        $totalAmount = $calculator->calculateTotalAmount();

        $this->assertEquals(600, $totalAmount); // 3 months * 200 monthly fees
    }
}
