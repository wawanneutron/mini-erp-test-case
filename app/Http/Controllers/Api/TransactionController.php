<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransactionRequest;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index()
    {
        return Transaction::with('items.product')
            ->latest()
            ->get();
    }

    public function store(StoreTransactionRequest $request)
    {
        $this->authorize('create', Transaction::class);

        return DB::transaction(function () use ($request) {

            $total = 0;

            $transaction = Transaction::create([
                'user_id' => Auth::user()->id,
                'total' => 0,
            ]);

            foreach ($request->items as $item) {

                $product = Product::findOrFail($item['product_id']);

                $price = $product->price;
                $qty = $item['qty'];
                $subtotal = $price * $qty;

                TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $product->id,
                    'qty' => $qty,
                    'price_at_transaction' => $price,
                    'subtotal' => $subtotal,
                ]);

                $total += $subtotal;
            }

            $transaction->update([
                'total' => $total
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Transaction created successfully',
                'data' => $transaction->load('items.product')
            ], 201);
        });
    }

    public function show(Transaction $transaction)
    {
        return $transaction->load('items.product');
    }
}
