<?php

namespace App\Services\InternetServiceProvider;

abstract class AbstractInvoiceCalculator implements InvoiceCalculatorInterface
{
    protected int $month = 0;
    protected int $monthlyFees = 0;

    public function __construct(int $monthlyFees)
    {
        $this->monthlyFees = $monthlyFees;
    }

    public function setMonth(int $month)
    {
        $this->month = $month;
    }

    public function calculateTotalAmount(): float|int
    {
        return $this->month * $this->monthlyFees;
    }
}
