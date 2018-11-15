<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SEO;
use Wishlist;
use App\Models\Order;
use Auth;

class ProfileController extends Controller
{
    public function profile() {
        SEO::setTitle('Личный кабинет');
        SEO::setDescription('Личный кабинет Etalon Holding');
        return view('pages.profile.index');
    }

    public function profileWishlist() {

        $wishlist = Wishlist::getUserWishlist(1)->load('product');
        foreach($wishlist as $product) {
            $id = $product->product_id;
            // dd($product)
            if(isset($product->product)) {
                
            } else {
                Wishlist::removeByProduct($id, Auth::user()->id);
            }
        }
        SEO::setTitle('Личный кабинет');
        SEO::setDescription('Личный кабинет Etalon Holding');
        return view('pages.profile.wishlist', compact(['wishlist']));
    }

    public function profilePurchases() {
        $orders = Order::where('user_id', Auth::user()->id)->get();
        SEO::setTitle('Личный кабинет');
        SEO::setDescription('Личный кабинет Etalon Holding');
        return view('pages.profile.purchases', compact(['orders']));
    }

    public function getOrderInProfile($id) {
        $order = Order::where('id', $id)->first();
        SEO::setTitle('Личный кабинет');
        SEO::setDescription('Личный кабинет Etalon Holding');
        return view('pages.profile.order', compact('order'));
    }

    public function profileHelp() {
        SEO::setTitle('Личный кабинет');
        SEO::setDescription('Личный кабинет Etalon Holding');
        return view('pages.profile.help');
    }
}
