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
        
        $id = $request->get('id');
        $quantity = $request->get('quantity', 1);
        $cart = Cart::content()->toArray();
        foreach($cart as $key=>$item) {
            if($item['id'] == $id) {
                $cartProductQty = $item['qty'];
                $sumQty = $cartProductQty + $quantity;
                $product = Product::find($id);
                if($sumQty >= $product->quantity) {
                    Toastr::warning('', 'Сейчас в наличии ' . $product->quantity . ' единиц выбранного Вами товара', ["positionClass" => "toast-top-right"]);
                    return redirect()->back();
                }
            }
        }
        $data = [];
        $amount = 0;
        if(!empty($request->get('equipment'))) {
            $equipments = $request->get('equipment');
            $products = Product::whereIn('id', $equipments)->select('id', 'title', 'quantity', 'price', 'image', 'article', 'api_id_product')->get()->toArray();
           
            foreach($products as $key=>$product) {
                $amount += $product['price'];
                $data[$product['id']] = [
                    'name' => $product['title'],
                    'price' => $product['price'],
                    'image' => isset($product['image']) ? asset('uploads/' . $product['image']) : '',
                    'article' => $product['article'],
                    'code' => $product['api_id_product']
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
        if($product->quantity < $quantity) {
            Toastr::warning('', 'Сейчас в наличии ' . $product->quantity . ' единиц выбранного Вами товара', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }
        $image = isset($product->image) ? asset('uploads/' . $product->image) : '';
      
        Cart::add($product->id, $product->title, $quantity, $product->price + $amount, ['article' => $product->article, 'code' => $product->api_id_product,'image' => $image, 'equipments' => $data, 'brand' => $product->brand, 'category' => $product->category->custom_name])->associate('App\\Models\\Product');
       
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
        $p = Product::find($product->id);
        if($request->get('change') == 'plus') {
            if($p->quantity <= $product->qty) {
                Toastr::warning('', 'Сейчас в наличии ' . $p->quantity . ' единиц выбранного Вами товара', ["positionClass" => "toast-top-right"]);
                return redirect()->back();
            }
            Cart::update($rowId, 1 + $product->qty);
        }
        else if($request->get('change') == 'minus') {
            Cart::update($rowId, $product->qty - 1);
        }
        return redirect()->back();
    }
}
