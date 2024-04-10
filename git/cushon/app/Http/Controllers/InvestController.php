<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DepositService;
use App\Models\Product;

use Session;

class InvestController extends Controller
{
    //
    public function index($id = 0)
    {
        return view('invest', ["funds" => Product::all(), "productId" => $id]);
    }

    public function save(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'amount' => 'required|regex:/^\d*(\.\d{2})?$/',
        ]);
        
        (new DepositService)
                ->create($request->all());

        $product = Product::find($request->product_id);
        
        Session::put('status', "You have chosen " . $product->name);

        return view('home');
    }
}
