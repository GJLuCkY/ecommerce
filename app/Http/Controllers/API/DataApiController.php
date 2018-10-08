<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\Order;

class DataApiController extends Controller
{
    public function postCreationAndUpdatingCategory(Request $request)
    {
       
        $categories = $request->get('GROUPS');
        if(isset($categories)) {
            foreach($categories as $item) {
                $searchCategory = ProductCategory::where('code', $item['ID'])->first();
                if(isset($searchCategory)) {
                    $searchCategory->title = $item['NAME'];
                    $searchCategory->code = $item['ID'];
                    $searchCategory->code_parent = $item['CODE_PARENT'];
                    $searchCategory->status = $item['PUBLISHED'];
                    $searchCategory->save();
                } else {
                    $category = new ProductCategory;
                    $category->title = $item['NAME'];
                    $category->code = $item['ID'];
                    $category->code_parent = $item['CODE_PARENT'];
                    $category->status = $item['PUBLISHED'];
                    $category->save();
                }
            }
            return response()->json([
                'message' => 'OK'
            ], 200);
        } else {
            return response()->json([
                'message' => 'No Content'
            ], 204);
        }
        
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
                    $category = ProductCategory::where('code', $item['ID_CATEGORY'])->first();
                    if(isset($category)) {
                        $searchProduct->category_id = $category->id;
                    }
                    $searchProduct->api_id_category = $item['ID_CATEGORY'];
                    $searchProduct->status = $item['PUBLISHED'];;
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
                    $product->status = $item['PUBLISHED'];;
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

    public function getNewOrders(Request $request)
    {
        $orders = Order::where('status', '!=', 'Отправлен')->get();

        $data = collect([]);

        foreach($orders as $key=>$order) {
            
            $products = collect([]);
            if(isset($order->products)) {
                foreach(json_decode($order->products) as $product) {
               
                    $products->push([
                        'name' => $product->item->title,
                        'article' => 'TODO',
                        'code' => 'TODO',
                        'quantity' => $product->qty,
                        'price' => $product->price,
                        'price_type' => 'KZT',
                        'price_id' => 'TODO',
                        'discount' => 'TODO'
                    ]);
                }
            }
            
            

            $data->push([
                'order_id' => $order->id, // идентификатор заказа на сайте
                'user_id' => $order->user_id,
                'user_type' => 'TODO', // Юр/физ лицо признак
                'iin_bin' => 'TODO', // Если Юр лицо то БИН/ИИН и РНН
                'fullname' => $order->name, // ФИО
                'address' => $order->address, // адрес
                'phone' => $order->phone, // телефон
                'email' => $order->email, // e-mail
                'products' => $products,
                'total_price' => 'TODO', // сумма заказа
                'comment' => $order->comment, // комментарий покупателя
                'payment_method' => 'TODO', // способ оплаты, 
                'payment_method_id' => 'TODO', // идентификатор способа оплаты
                'date_payment' => 'TODO', // дата оплаты
                'delivery_method' => 'TODO', // Способ доставки
                'delivery_method_id' => 'TODO', // идентификатор способа доставки
                'created_at' => $order->created_at // Дата создания заказа
            ]);
            // $order->update([
            //     'status' => 'Отправлен'
            // ]);
        }
        return response()->json(collect([$data]));
    }
}
