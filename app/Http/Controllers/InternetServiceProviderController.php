<?php

namespace App\Http\Controllers;

use App\Services\InternetServiceProvider\InternetServiceProviderInterface;
use Illuminate\Container\Container;
use Illuminate\Http\Request;

class InternetServiceProviderController extends Controller
{
    // public function getInvoiceAmount(Request $request, InternetServiceProviderInterface $internetServiceProvider)
    // {
    //     $month = $request->input('month', 1);

    //     $internetServiceProvider->setMonth($month);

    //     return response()->json([
    //         'data' => $internetServiceProvider->calculateTotalAmount(),
    //     ]);
    // }

    public function getInvoiceAmount(Request $request, string $entity)
    {
        $month = $request->input('month', 1);
        $calculator = Container::getInstance()->make($this->getCalculatorClass($entity));
        $calculator->setMonth($month);

        return response()->json([
            'data' => $calculator->calculateTotalAmount(),
        ]);
    }

    protected function getCalculatorClass(string $entity)
    {
        $mapping = [
            'mpt' => 'MptCalculator',
            'ooredoo' => 'OoredooCalculator',
        ];

        return $mapping[$entity] ?? null;
    }
}
