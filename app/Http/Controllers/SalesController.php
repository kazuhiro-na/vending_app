<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function purchase(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');
        $product = Product::find($productId);

        if ($product && $product->stock >= $quantity) {
            //在庫がある場合
            $product->stock -= $quantity;
            $product->save();
            //売上の記録
            $sale = new Sale();
            $sale->product_id = $productId;
            $sale->quantity = $quantity;
            $sale->save();

            return response()->json(['message' => config('messages.purchase')], 200);
        } elseif ($product && $product->stock === 0) {
            //在庫が0の場合
            return response()->json(['message' => config('messages.purchase_0')], 400);
        } else {
            //商品が存在しない場合
            return response()->json(['message' => config('messages.purchase_error')], 404);
        }
    }
}
