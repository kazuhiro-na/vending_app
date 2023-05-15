<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;

class ProductsController extends Controller
{   
    //商品一覧を表示
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }
    //商品登録フォームを表示
    public function create()
    {
        $companies = Company::all();
        return view('products.create', compact('companies'));
    }
    //商品を登録する

    public function store(Request $request)
    {
        $product = new Product;
        $product->company_id = $request->company_id;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $product->stock;
        $product->comment = $product->comment;
        $product->save();

        return redirect()->route('products.index');
    }


}
