<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Value;
use App\Models\Product;
use App\Models\Order;

class DataApiController extends Controller
{
    public function postCreationAndUpdatingCategory(Request $request)
    {

        $categories = $request->get('GROUPS');
        if(isset($categories)) {
            foreach($categories as $item) {
                $searchCategory = Category::where('code', $item['ID'])->first();
                if(isset($searchCategory)) {
                    $searchCategory->title = $item['NAME'];
                    $searchCategory->code = $item['ID'];
                    $searchCategory->code_parent = $item['CODE_PARENT'];
                    $searchCategory->status = $item['PUBLISHED'];

                    $parentSearchCategory = Category::where('code', $item['CODE_PARENT'])->first();
                    if(isset($parentSearchCategory)) {
                        $searchCategory->parent_id = $parentSearchCategory->id;
                    }


                    $searchCategory->save();
                } else {
                    $category = new Category;
                    $category->title = $item['NAME'];
                    $category->code = $item['ID'];
                    $category->code_parent = $item['CODE_PARENT'];
                    $category->status = $item['PUBLISHED'];

                    $parentSearchCategory = Category::where('code', $item['CODE_PARENT'])->first();
                    if(isset($parentSearchCategory)) {
                        $category->parent_id = $parentSearchCategory->id;
                    }

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
                // dd($item);
                $searchProduct = Product::where('api_id_product', $item['ID'])->first();
                if(isset($searchProduct)) {
                    $searchProduct->title = $item['NAME'];
                    $searchProduct->article = $item['ARTICUL'];
                    // $searchProduct->price = $item['PRICE'];
                    $searchProduct->quantity = $item['BALANCE'];
                    $searchProduct->api_id_product = $item['ID'];
                    $category = Category::where('code', $item['ID_CATEGORY'])->first();
                    if(isset($category)) {
                        $searchProduct->category_id = $category->id;
                    }
                    $searchProduct->api_id_category = $item['ID_CATEGORY'];
                    $searchProduct->status = $item['PUBLISHED'];;
                    $searchProduct->save();

                    if(isset($item['FILTERS'])) {
                        foreach($item['FILTERS'] as $key=>$filter) {
                            if(strlen($filter) > 0) {
                                $value = Value::where('name', $filter)->where('filter_id', $key)->first();
                                if(isset($value)) {
                                    $value->products()->attach($searchProduct->id);
                                } else {
                                    $value = new Value();
                                    $value->name = $filter;
                                    $value->filter_id = $key;
                                    $value->save();
                                    $value->products()->attach($searchProduct->id);
                                }
                            }
                        }
                    }

                } else {
                    $created = true;
                    $product = new Product;
                    $product->title = $item['NAME'];
                    $product->article = $item['ARTICUL'];
                    // $product->price = $item['PRICE'];
                    $product->quantity = $item['BALANCE'];
                    $product->api_id_product = $item['ID'];
                    $product->api_id_category = $item['ID_CATEGORY'];
                    $category = Category::where('code', $item['ID_CATEGORY'])->first();
                    if(isset($category)) {
                        $product->category_id = $category->id;
                    }
                    $product->status = $item['PUBLISHED'];;
                    $product->save();

                    foreach($item['FILTERS'] as $key=>$filter) {
                        if(strlen($filter) > 0) {
                            $value = Value::where('name', $filter)->where('filter_id', $key)->first();
                            if(isset($value)) {
                                $value->products()->attach($product->id);
                            } else {
                                $value = new Value();
                                $value->name = $filter;
                                $value->filter_id = $key;
                                $value->save();
                                $value->products()->attach($product->id);
                            }
                        }
                    }
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
        $orders = Order::whereIn('status', ['create', 'changed', 'paid'])->get();
        // dd($orders);
        $data = collect([]);
        $data2 = collect([
            'DOCUMENT_OUT' => $data
        ]);
        if(count($orders) > 0) {
            foreach($orders as $key=>$order) {

                $products = collect([]);
                $totalPrice = 0;
                if(isset($order->products)) {
                    foreach($order->products as $product) {
                        $equipment = collect([]);
                        if(count((array)$product->options->equipments) > 0) {
                            foreach((array)$product->options->equipments as $key=>$eq) {
                                $equipment->push([
                                    "name" => $eq->name,
                                    "article" => $eq->article,
                                    "code"=> $eq->code,
                                    "quantity" => intval($product->qty),
                                    "price" => intval($eq->price)
                                ]);
                            }
                        }
                        $products->push([
                            'name' => $product->name,
                            'article' => $product->options->article,
                            'code' => $product->options->code,
                            'quantity' => intval($product->qty),
                            'price' => intval($product->price),
                            // 'price_type' => 'Тенге',
                            // 'price_id' => 'KZT',
                            'discount' => null,
                            'equipment' => $equipment
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
                //dd($order->updated_at);
                $data->push([
                    'order_id' => $order->id, // идентификатор заказа на сайте
                    'user_id' => $order->user_id === null ? 0 : $order->user_id,
                    // 'user_type' => $order->user_type, // Юр/физ лицо признак
                    // 'iin_bin' => $order->iin_bin, // Если Юр лицо то БИН/ИИН и РНН
                    'fullname' => $order->name, // ФИО
                    'address' => $order->address, // адрес
                    'phone' => $order->phone, // телефон
                    'email' => $order->email, // e-mail
                    // 'total_price' => $order->total_price, // сумма заказа
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
                    'status' => 'changed'
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
        $orders = $request->get("DOCUMENT_OUT");
        if(isset($orders)) {
            $have = false;
            foreach($orders as $orderItemsBitrix) {

                foreach($orders as $orderBitrix) {
                    $order = Order::find($orderBitrix['order_id']);
                    if(isset($order)) {
                        if(isset($orderBitrix['products'])) {
                            $have = true;
                            $orderProducts = $order->products;
                            $newOrderPoducts = [];
                            $newEquipments = [];
                            $productsBitrix = (array)$orderBitrix['products'];
    
                            foreach((array)$productsBitrix as $productBitrix) {
                                foreach((object)$orderProducts as $orderProductKey=>$orderProduct) {
                                    if($productBitrix['code'] == $orderProduct->options->code) {
                                        $newOrderPoducts[$orderProductKey] = $orderProduct;
                                        $newOrderPoducts[$orderProductKey]->name = $productBitrix['name'];
                                        $newOrderPoducts[$orderProductKey]->qty = $productBitrix['quantity'];
                                        $newOrderPoducts[$orderProductKey]->price = $productBitrix['price'];
                                        $newOrderPoducts[$orderProductKey]->options->code = $productBitrix['code'];
                                        $newOrderPoducts[$orderProductKey]->options->article = $productBitrix['article'];
    
                                        if(count((array)$productBitrix['equipment']) > 0) {
                                            foreach((array)$productBitrix['equipment'] as $key=>$equipmentBitrix) {
                                                $equipment = Product::where('api_id_product', $equipmentBitrix['code'])->first();
                                                if(isset($equipment)) {
                                                    $newEquipments[$equipment->id] = [
                                                        'code' => $equipmentBitrix['code'],
                                                        'name' => $equipmentBitrix['name'],
                                                        'image' => $equipment->image,
                                                        'price' => $equipment['price'],
                                                        'article' => $equipmentBitrix['article']
                                                    ];
                                                }
    
                                            }
                                            $newOrderPoducts[$orderProductKey]->options->equipments = $newEquipments;
                                        }
                                    }
                                }
                            }
                        }
    
                        if($orderBitrix['user_id'] == 0) {
                            $userId = null;
                        } else {
                            $userId = $orderBitrix['user_id'];
                        }
                        
                        $order->update([
                            'user_id' => $userId,
                            'name' => $orderBitrix['fullname'],
                            'address' => $orderBitrix['address'],
                            'phone' => $orderBitrix['phone'],
                            'delivery_method' => $orderBitrix['delivery_method_id'],
                            'method' => $orderBitrix['payment_method_id'],
                            'comment' => $orderBitrix['comment'],
                            'email' => $orderBitrix['email'],
                            'products' => (object)$newOrderPoducts
                        ]);
                    }
                }
            }
            if($have){
                return response()->json([
                    'message' => 'OK'
                ], 200);
            } else {
                dd(1);
                return response()->json([
                    'message' => 'No content / Not Found'
                ], 204);
            }
        } else {
            return response()->json([
                'message' => 'No Content'
            ], 204);
        }
    }
}
