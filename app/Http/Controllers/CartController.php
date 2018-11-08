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

    public function getAddToCart(Request $request, $id) {
        $product = Product::find($id);

        Cart::add($product->id, $product->title, 1, $product->price, ['image' => asset('uploads/' . $product->image)]);
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
        
        if($request->get('change') == 'plus') {
            $cart = cart()->incrementQuantityAt($request->get('product'));
        }
        else if($request->get('change') == 'minus') {
            $cart = cart()->decrementQuantityAt($request->get('product'));
        }

        return redirect()->back();
    }
}
