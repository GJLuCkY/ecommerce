<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Wishlist;
use Toastr;
use Auth;

class WishlistController extends Controller
{
    public function addWishlist($id) {
        if (Auth::check()) {
            Wishlist::add($id, Auth::user()->id);
            Toastr::success('', 'Товар добавлен в избранное!', ["positionClass" => "toast-top-right"]);
        } else {
            Toastr::success('', 'Войдите или зарегистрируйтесь', ["positionClass" => "toast-top-right"]);
        }
        return redirect()->back();
    }

    public function removeWishlist($id) {
        Wishlist::removeByProduct($id, Auth::user()->id);
        Toastr::success('', 'Вы удалили товар из избранного!', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
}
