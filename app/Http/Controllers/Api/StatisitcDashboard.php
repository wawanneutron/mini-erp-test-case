<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;

class StatisitcDashboard extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalTransaction = Transaction::count();
        $totalRevenue = Transaction::sum('total');

        return response()->json([
            'success' => true,
            'data' => [
                'total_products' => $totalProducts,
                'total_transactions' => $totalTransaction,
                'total_revenue' => $totalRevenue,
            ],
        ]);
    }
}
