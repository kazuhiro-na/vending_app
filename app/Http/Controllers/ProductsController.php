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
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'company_id' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'comment' => 'nullable',
        ]);

        $product = new Product;
        $product->name = $request->name;
        $product->company_id = $request->company_id;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->comment = $request->comment;
        $product->save();

        return redirect('/products')->with('success', '商品を登録しました。');
    }
    //商品詳細を表示
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', ['product' => $product]);
    }
    //商品編集画面を表示
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $companies = Company::all();
        return view('products.edit', ['product' => $product, 'companies' => $companies]);
    }


}
