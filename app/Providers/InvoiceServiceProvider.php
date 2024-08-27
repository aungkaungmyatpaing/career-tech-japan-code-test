<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\InternetServiceProvider\MptInvoiceCalculator;
use App\Services\InternetServiceProvider\OoredooInvoiceCalculator;

class InvoiceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('MptCalculator', function() {
            return new MptInvoiceCalculator();
        });

        $this->app->bind('OoredooCalculator', function() {
            return new OoredooInvoiceCalculator();
        });
    }
}
