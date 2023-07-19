<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    public function purchase(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');
        $product = Product::find($productId);

        //商品が存在しない場合
        if(!$product) {
            return response()->json(['message' => config('messages.purchase_error')], 404);
        }

        DB::beginTransaction();
        
        try {
            if ($product && $product->stock >= $quantity) {
                //在庫がある場合
                $product->stock -= $quantity;
                $product->save();
                //売上の記録
                $sale = new Sale();
                $sale->product_id = $productId;
                $sale->quantity = $quantity;
                $sale->save();

                DB::commit();

                return response()->json(['message' => config('messages.purchase')], 200);
            } else {
                //在庫が不足している場合
                DB::rollBack();
                return response()->json(['message' => config('messages.purchase_0')], 400);
            }
        } catch (\Exception $e) {
            //例外が発生した場合
            DB::rollBack();

            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }
}
