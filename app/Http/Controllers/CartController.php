<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use Session;
use SEO;
use App\Models\Product;
use Toastr;

class CartController extends Controller
{
    public function cart() {
        
        SEO::setTitle('Корзина');
        SEO::setDescription('Корзина Etalon Holding');
        
        return view('pages.cart');
    }

    public function getAddToCart(Request $request) {
       
        $quantity = $request->get('quantity', 1);
        $id = $request->get('id');
        // dd($id);
        $data = [];
        $amount = 0;
        if(!empty($request->get('equipment'))) {
            $equipments = $request->get('equipment');
            $products = Product::whereIn('id', $equipments)->select('id', 'title', 'quantity', 'price', 'image')->get()->toArray();
            foreach($products as $key=>$product) {
                $amount += $product['price'];
                $data[$product['id']] = [
                    'name' => $product['title'],
                    'price' => $product['price'],
                    'image' => isset($product['image']) ? asset('uploads/' . $product['image']) : ''
                ];
            }
            
        }
        if(empty($id)) {
            Toastr::warning('', 'Что-то пошло не так!', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }
        
        $product = Product::where('id', $id)->where('status', 1)->first();
        if(!isset($product)) {
            Toastr::warning('', 'Этот товар временно недоступен!', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }
        $image = isset($product->image) ? asset('uploads/' . $product->image) : '';
        Cart::add($product->id, $product->title, $quantity, $product->price + $amount, ['image' => $image, 'equipments' => $data, 'brand' => $product->brand, 'category' => $product->category->custom_name])->associate('App\\Models\\Product');
        // Cart::destroy();
        Toastr::success('', 'Товар добавлен в корзину!', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    public function removeToCart(Request $request, $id) {
       
        Cart::remove($id);
        Toastr::success('', 'Товар добавлен в корзину!', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    public function cartChangeQuantity(Request $request)
    {
        $rowId = $request->get('product');
        $product = Cart::get($rowId);
        
        if($request->get('change') == 'plus') {
            // TODO
            Cart::update($rowId, 1 + $product->qty);
        }
        else if($request->get('change') == 'minus') {
            Cart::update($rowId, $product->qty - 1);
        }

        return redirect()->back();
    }
}
