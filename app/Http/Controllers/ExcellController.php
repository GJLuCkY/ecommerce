<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Value;
use Excel;

class ExcellController extends Controller
{
    public function importExcell(Request $request)
    {
        // dd(1);
        $request->validate([
            'import_file' => 'required'
        ]);
 
        $path = $request->file('import_file')->getRealPath();
        $data = Excel::load($path)->get();
        // dd($data);
        if($data->count()){
            foreach ($data as $key => $value) {
                $arr[] = [
                    'title' => $value->title, 
                    'category_id' => 1, 
                    'price' => 1000, 
                    'quantity' => 10, 
                    'status' => 1, 
                    'article' => $value->article,

                    'filters' => [
                        1 => $value->brand,
                        6 => $value->collection,
                        7 => $value->decor,
                        8 => $value->class,
                        9 => $value->strana,
                        10 => $value->ves,
                    ]
                    
                ];
            }
            // dd($arr);
            if(!empty($arr)){
                foreach($arr as $item) {
                    $product = new Product();
                    $product->title = $item['title'];
                    $product->category_id = 1;
                    $product->status = 1;
                    $product->quantity = $item['quantity'];
                    $product->article = $item['article'];
                    $product->save();

                    foreach($item['filters'] as $key=>$filter) {
                        if(strlen($filter) > 0) {
                            $value = Value::where('name', $filter)->where('filter_id', $key)->first();
                            if(isset($value)) {
                                $value->products()->attach($product->id);
                            } else {
                                $value = new Value;
                                $value->name = $filter;
                                $value->filter_id = $key;
                                $value->save();
                                $value->products()->attach($product->id);
                            }
                        }
                    }
                        

                    
                    

                }
                Product::insert($arr);
            }
        }
 
        return back()->with('success', 'Insert Record successfully.');
    }
}
