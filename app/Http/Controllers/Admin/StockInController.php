<?php

namespace App\Http\Controllers\Admin;

use App\Models\Items;
use App\Models\stockIn;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class StockInController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stocks = StockIn::all();
        return view('admin.stockIn.index', compact('stocks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $items = Items::all();
        $supplier = Supplier::all();
        return view('admin.stockIn.create_stockIn', compact('items', 'supplier'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'id_items' => 'required|exists:items,id',
            'id_suppliers' => 'required|exists:supplier,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $stockIn = stockIn::create([
            'id_items' => $validate['id_items'],
            'id_suppliers' => $validate['id_suppliers'],
            'quantity' => $validate['quantity'],
        ]);
        $product = $stockIn;
        $product->quantity += $validate['quantity'];
        $product->save();

        return view('admin.stockIn.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
