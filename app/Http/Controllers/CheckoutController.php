<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SEO;
use Session;
use Cart;
use Auth;
use App\Models\Order;
use Toastr;

class CheckoutController extends Controller
{

    public function checkout() {
        // Session::forget('cart');
        SEO::setTitle('Оформление заказа');
        SEO::setDescription('Оформление заказа Etalon Holding');
        // dd(Cart::count());
        if(Cart::count() < 1){
            return redirect()->route('cart');
        }
       
        return view('pages.checkout');
    }

    public function postCheckout(Request $request) {
        $user = Auth::user();
        
        $order = new Order;
        if($request->get('user_id') != 0) {
            $order->user_id = $request->get('user_id');
            // $order->iin_bin = $request->get('usertype');
        }
        $order->phone = $request->get('phone');
        $order->name = $request->get('name');
        $order->city = 'Almaty';
        $order->address = $request->get('address');
        $order->email = $request->get('email');
        $order->comment = $request->get('comment');
        $order->method = $request->get('method');
        $order->status = 'create';
        $order->products = Cart::content()->toArray();
        $order->delivery_method = $request->get('delivery_method');
        $order->user_type = $request->get('usertype');
        $order->total_price = Cart::total();
        $order->save();
        // $order->products()->attach(array_keys($productsId));
        
        Toastr::success('', 'Вы успешно оформили заказ', ["positionClass" => "toast-top-right"]);
        return redirect()->route('homepage');
    }
}
