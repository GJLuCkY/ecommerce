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
        // $orders = Order::where('status', '!=', 'Отправлен')->get();
        $orders = Order::get();
        $data = collect([]);
        $data2 = collect([
            'DOCUMENT_OUT' => $data
        ]);
        if(count($orders) > 0) {
            foreach($orders as $key=>$order) {
            
                $products = collect([]);
                $totalPrice = 0;
                if(isset($order->products)) {
                    foreach(json_decode($order->products) as $product) {
                        $totalPrice = $totalPrice + $product->price;
                        $products->push([
                            'name' => $product->item->title,
                            'article' => 'Н0000005031',
                            'code' => 'TODO',
                            'quantity' => $product->qty,
                            'price' => $product->price,
                            'price_type' => 'Тенге',
                            'price_id' => 'KZT',
                            'discount' => null
                        ]);
                    }
                }

                if(isset($order->method)) {
                    if($order->method == 'cart') {
                        $cartMethod = 'Карта';
                    } else {
                        $cartMethod = 'Наличные';
                    }
                } else {
                    $cartMethod = 'Другое';
                }

                if(isset($order->delivery_method)) {
                    if($order->delivery_method == 'dostavka') {
                        $delivMethod = 'Доставка';
                    } else {
                        $delivMethod = 'Самовывоз';
                    }
                } else {
                    $delivMethod = 'Другое';
                }
                
                $data->push([
                    'order_id' => $order->id, // идентификатор заказа на сайте
                    'user_id' => $order->user_id,
                    'user_type' => $order->user_type, // Юр/физ лицо признак
                    'iin_bin' => $order->iin_bin, // Если Юр лицо то БИН/ИИН и РНН
                    'fullname' => $order->name, // ФИО
                    'address' => $order->address, // адрес
                    'phone' => $order->phone, // телефон
                    'email' => $order->email, // e-mail
                    'total_price' => $totalPrice, // сумма заказа
                    'comment' => $order->comment, // комментарий покупателя
                    'payment_method' => $cartMethod, // способ оплаты, 
                    'payment_method_id' => $order->method, // идентификатор способа оплаты
                    'date_payment' => $order->updated_at, // дата оплаты
                    'delivery_method' => $delivMethod, // Способ доставки
                    'delivery_method_id' => $order->delivery_method, // идентификатор способа доставки
                    'created_at' => $order->created_at, // Дата создания заказа
                    'products' => $products,
                ]);
                $order->update([
                    'status' => 'Отправлен'
                ]);
            }
            return response()->json($data2);
        } else {
            $products = collect([]);
            $products->push([
                'OUT' => 'NO'
            ]);
            $data = [
                "DOCUMENT_OUT" => $products
            ];
            return response()->json($data);
        }
        
        
    }

    public function changeOrder(Request $request)
    {
        $orders = $request->get('DOCUMENT_OUT');
        if(isset($orders)) {
            
            foreach($orders as $orderItemsBitrix) {
                foreach($orderItemsBitrix as $orderBitrix) {
                    $order = Order::find($orderBitrix['order_id']);
                    $order->update([
                        'name' => $orderBitrix['fullname'],
                        'address' => $orderBitrix['address'],
                        'phone' => $orderBitrix['phone'],
                        'delivery_method' => $orderBitrix['delivery_method_id'],
                        'method' => $orderBitrix['payment_method_id'],
                        'comment' => $orderBitrix['comment']
                    ]);


                //     "order_id": 5,
                // "created_at": "2018-06-21T09:56:51Z",
                // "fullname": "Нурлан",
                // "user_id": 2,
                // "date_payment": "2018-10-09T00:00:00Z",
                // "address": "Аль Фараби 53б",
                // "phone": "+7 (123) 123-12-31",
                // "email": "balymbetov.temirlan@gmail.com",
                // "delivery_method": "Самовывоз",
                // "delivery_method_id": "samovyvoz",
                // "payment_method": "Наличные",
                // "payment_method_id": "nal",
                // "comment": "",
                // "products": [
                //     {
                //         "name": "07 Внутренний угол INDO",
                //         "article": "",
                //         "code": "Н0000005031",
                //         "quantity": 2,
                //         "price": 123123,
                //         "discount": 0
                //     },
                //     {
                //         "name": "07 Внутренний угол INDO",
                //         "article": "",
                //         "code": "Н0000005031",
                //         "quantity": 1,
                //         "price": 100,
                //         "discount": 0
                //     }
                // ]
                }
            }
        } else {
            dd('Нет данных');
        }
    }
}
