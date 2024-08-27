<?php
namespace App\Services\InternetServiceProvider;

class OoredooInvoiceCalculator extends AbstractInvoiceCalculator
{
    public function __construct()
    {
        parent::__construct(150); // Monthly fees for Ooredoo
    }
}
