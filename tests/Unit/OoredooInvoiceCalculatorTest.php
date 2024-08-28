<?php

namespace Tests\Unit;

use App\Services\InternetServiceProvider\OoredooInvoiceCalculator;
use PHPUnit\Framework\TestCase;

class OoredooInvoiceCalculatorTest extends TestCase
{
    /** @test */
    public function it_calculates_total_amount_for_ooredoo()
    {
        $calculator = new OoredooInvoiceCalculator();
        $calculator->setMonth(4); // For example, 4 months

        $totalAmount = $calculator->calculateTotalAmount();

        $this->assertEquals(600, $totalAmount); // 4 months * 150 monthly fees
    }
}
