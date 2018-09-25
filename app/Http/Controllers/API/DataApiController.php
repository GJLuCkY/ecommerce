<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Models\Product;

class DataApiController extends Controller
{
    public function postCreationAndUpdatingCategory(Request $request)
    {
        $categories = $request->get('GROUPS');
        if(isset($categories)) {
            foreach($categories as $item) {
                $searchCategory = ProductCategory::where('code', $item['CODE'])->first();
                if(isset($searchCategory)) {
                    $searchCategory->title = $item['NAME'];
                    $searchCategory->code = $item['CODE'];
                    $searchCategory->code_parent = $item['CODE_PARENT'];
                    $searchCategory->parent = $item['PARENT'];
                    $searchCategory->save();
                } else {
                    $category = new ProductCategory;
                    $category->title = $item['NAME'];
                    $category->code = $item['CODE'];
                    $category->code_parent = $item['CODE_PARENT'];
                    $category->parent = $item['PARENT'];
                    $category->save();
                }
            }
        }
        return response()->json([
            'message' => 'OK'
        ], 200);
        
    }

    public function postCreationAndUpdatingProducts(Request $request)
    {
        $products = $request->get('NOMENCLATURE');
        if(isset($products)) {
            $created = false;
            foreach($products as $item) {
                $searchProduct = Product::where('api_id_product', $item['ID'])->first();
                if(isset($searchProduct)) {
                    $searchProduct->title = $item['NAME'];
                    $searchProduct->article = $item['ARTICUL'];
                    $searchProduct->price = $item['PRICE'];
                    $searchProduct->quantity = $item['BALANCE'];
                    $searchProduct->api_id_product = $item['ID'];
                    $searchProduct->api_id_category = $item['ID_CATEGORY'];
                    $searchProduct->save();
                } else {
                    $created = true;
                    $product = new Product;
                    $product->title = $item['NAME'];
                    $product->article = $item['ARTICUL'];
                    $product->price = $item['PRICE'];
                    $product->quantity = $item['BALANCE'];
                    $product->api_id_product = $item['ID'];
                    $product->api_id_category = $item['ID_CATEGORY'];
                    $product->save();
                }
            }
            if($created) {
                return response()->json([
                    'message' => 'Created'
                ], 201);
            } else {
                return response()->json([
                    'message' => 'OK'
                ], 200);
            }
            
        } else {
            return response()->json([
                'message' => 'No Content'
            ], 204);
        } 
    }
}
