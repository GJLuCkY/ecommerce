<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use DB;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $searchCategory = $request->get('category', 1);
        $searchText = $request->get('search');

        
            $products = Product::search($searchText)->where('category_id', $searchCategory)->paginate(16);
        

        return view('pages.search', compact('products', 'searchCategory', 'searchText'));


    }
}
