<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DataApiController extends Controller
{
    public function postCreationAndUpdatingData(Request $request)
    {
        return response()->json($request);
    }
}
