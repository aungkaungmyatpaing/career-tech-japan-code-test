<?php

namespace App\Services\InternetServiceProvider;

interface InvoiceCalculatorInterface
{
    public function setMonth(int $month);
    public function calculateTotalAmount(): float|int;
}
