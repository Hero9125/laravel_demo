<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;


class SalesController extends Controller
{
  public function index()
    {
        $sales = Sale::all();
        return view('sales.index', compact('sales'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'unit_cost' => 'required|numeric|min:0.01',
        ]);

        $product = $validated['product'];
        $quantity = $validated['quantity'];
        $unit_cost = $validated['unit_cost'];

        $cost = $quantity * $unit_cost;

        if ($product == 'Gold coffee') {
            $profit_margin = 0.25;
        } elseif ($product == 'Arabic coffee') {
            $profit_margin = 0.15;
        } else {
            return redirect()->route('sales.index')->with('error', 'Invalid product selected');
        }

        $shipping_cost = 10.00;
        $selling_price = ($cost / (1 - $profit_margin)) + $shipping_cost;

        Sale::create([
            'product' => $product,
            'quantity' => $quantity,
            'unit_cost' => $unit_cost,
            'cost' => $cost,
            'selling_price' => $selling_price,
        ]);

        return redirect()->route('sales.index')->with('sellingPrice', $selling_price);
    }
}
