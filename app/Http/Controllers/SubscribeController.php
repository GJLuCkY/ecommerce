<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Newsletter;
use Toastr;

class SubscribeController extends Controller
{
    public function subscribe(Request $request) {
        Newsletter::subscribe($request->get('email'));
        Toastr::success('', 'Вы успешно подписались на рассылку!', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
}
