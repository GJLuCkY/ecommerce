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
        return response()->json($request->all());
        $categories = $request->get('GROUPS');
        if(isset($categories)) {
            foreach($categories as $item) {
                $searchCategory = ProductCategory::where('code', $item['ID'])->first();
                if(isset($searchCategory)) {
                    $searchCategory->title = $item['NAME'];
                    $searchCategory->code = $item['ID'];
                    $searchCategory->code_parent = $item['CODE_PARENT'];
                    $searchCategory->status = 0;
                    $searchCategory->save();
                } else {
                    $category = new ProductCategory;
                    $category->title = $item['NAME'];
                    $category->code = $item['ID'];
                    $category->code_parent = $item['CODE_PARENT'];
                    $category->status = 0;
                    $category->save();
                }
            }
            return response()->json([
                'message' => 'OK'
            ], 200);
        }
        
        
    }

    public function postCreationAndUpdatingProducts(Request $request)
    {
        return response()->json($request->all());
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
                    $category = ProductCategory::where('code', $item['ID_CATEGORY'])->first();
                    if(isset($category)) {
                        $searchProduct->category_id = $category->id;
                    }
                    $searchProduct->api_id_category = $item['ID_CATEGORY'];
                    $searchProduct->status = 0;
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
                    $category = ProductCategory::where('code', $item['ID_CATEGORY'])->first();
                    if(isset($category)) {
                        $product->category_id = $category->id;
                    }
                    $product->status = 0;
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
