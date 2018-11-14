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
                    'minimum' => $value->minimum,
                    'filters' => [
                        29 => $value->upakovka, // Упаковка
                        1 => $value->brand, // Brand
                        6 => $value->collection, // Коллекция
                        7 => $value->decor, // Декор
                        8 => $value->class, // Класс истираеомости
                        9 => $value->strana, // Производитель
                        10 => $value->ves, // Вес
                        11 => $value->shirina, // Ширина
                        12 => $value->dlina, // Длина
                        13 => $value->vysota, // Высота
                        14 => $value->tolwina, // Толщина
                        15 => $value->plotnost, // Плотность
                        16 => $value->vyravnivanie, // Выравнивание
                        17 => $value->zvuk,
                        18 => $value->termo, 
                        19 => $value->nagruzka,
                        20 => $value->razmer,
                        21 => $value->faska,
                        2 => $value->color,
                        22 => $value->harak,
                        23 => $value->structure,
                        24 => $value->material,
                        25 => $value->forma_vypuska,
                        26 => $value->steklo,
                        27 => $value->pokrytie,
                        28 => $value->type,
                        // 1 => minimum,
                    ]
                    
                ];
            }
            // dd($arr);
            if(!empty($arr)){
                foreach($arr as $item) {
                    $product = new Product();
                    $product->title = $item['title'];
                    $product->category_id = 1326;
                    $product->status = 1;
                    $product->quantity = $item['quantity'];
                    $product->article = $item['article'];
                    $product->minimum = $item['minimum'];
                    $product->price = random_int(300, 700) * 50;
                    $product->save();

                    foreach($item['filters'] as $key=>$filter) {
                        if(strlen($filter) > 0) {
                            $value = Value::where('name', $filter)->where('filter_id', $key)->first();
                            if(isset($value)) {
                                $value->products()->attach($product->id);
                            } else {
                                $value = new Value();
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
