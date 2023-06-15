<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use App\Models\Company;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{   
    //商品一覧を表示
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('product_name')) {
            $query->where('name', 'like', '%' . $request->input('product_name') . '%');
        }

        if ($request->filled('company_name')) {
            $query->whereHas('company', function($query) use ($request) {
                $query->where('company_name', $request->input('company_name'));
            });
        }

        $products = $query->get();
        $companies = Company::all();
        
        return view('products.index', compact('products', 'companies'));
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
        DB::beginTransaction();

        try {
            $validatedData = $request->validate([
                'name' => 'required|max:255',
                'company_id' => 'required',
                'price' => 'required|numeric',
                'stock' => 'required|numeric',
                'comment' => 'nullable',
                'image_path' => 'required|image|mimes:jpeg,png,jpg,gif',
            ]);

            $product = Product::createProduct($request->all());

            DB::commit();
    
            return redirect('/products')->with('success', config('messages.created'));
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', config('messages.create_error'));
        }
        
    }
    //商品詳細を表示
    public function show($productId)
    {
        $product = (new Product)->getProduct($productId);
        return view('products.show', ['product' => $product]);
    }
    //商品編集画面を表示
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $companies = Company::all();
        return view('products.edit', ['product' => $product, 'companies' => $companies]);
    }
    //商品情報を更新
    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $rules = [
                'name' => 'required|max:255',
                'company_id' => 'required',
                'price' => 'required|numeric',
                'stock' => 'required|numeric',
                'comment' => 'nullable',
                'image_path' => 'required|image|mimes:jpeg,png,jpg,gif',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            
            $data = $request->all();

            $product = (new Product)->updateProduct($id, $data);

            DB::commit();

            return redirect()->route('products.show', ['product' => $product->id])->with('success', config('messages.updated'));
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', config('messages.update_error'));
        }
    }

    public function destroy(Product $product)
    {
        DB::beginTransaction();

        try {
            $product->delete();
            DB::commit();

            return redirect()->route('products.index')->with('success', config('messages.deleted'));
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', config('messages.delete_error'));
        }
    }


}
