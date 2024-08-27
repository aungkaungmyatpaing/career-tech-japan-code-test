<?php
namespace App\Services\InternetServiceProvider;

class MptInvoiceCalculator extends AbstractInvoiceCalculator
{
    public function __construct()
    {
        parent::__construct(200); // Monthly fees for Mpt
    }
}
