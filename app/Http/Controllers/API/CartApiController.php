<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cart;

class CartApiController extends Controller
{
    public function getBasket()
    {
        return response()->json([
            'data' => Cart::content()->toArray(),
            'total' => Cart::total(),
            'count' => Cart::content()->count()
        ], 200);
    }
}