<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Value;
use Excel;
use Illuminate\Support\Facades\Input;
use Toastr;

class ExcellController extends Controller
{
    public function importExcell(Request $request)
    {
        // if(empty($request->get('import_file'))) {
        //     Toastr::warning('', 'Выберите excel файл', ["positionClass" => "toast-top-right"]);
        //     return redirect()->back();
        // }
        $extensions = [
            'csv',
            'xls',
            'xlm',
            'xla',
            'xlt'
        ];

        if(!in_array($request->file('import_file')->getClientOriginalExtension(), $extensions)) {
            Toastr::warning('', 'Выберите excel файл', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }
        $categoryId = $request->get('category');
 
        $path = $request->file('import_file')->getRealPath();
        $data = Excel::load($path)->get();
    
        if($data->count()){
            foreach ($data as $key => $value) {
                $arr[] = [
                    'title' => $value->title, //1
                    'category_id' => $categoryId, //1
                    'price' => $value->price, //1
                    'quantity' => $value->kolichestvo, 
                    'status' => 0, 
                    'packaging' => $value->upakovka,
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
                    ]
                    
                ];
            }
            if(!empty($arr)){
                // dd($arr);
                foreach($arr as $item) {
                    $product = Product::where('article', $item['article'])->first();
                    if(isset($product)){
                    } else {
                        $product = new Product();
                    }
                    $product->title = $item['title'];
                    $product->category_id = $categoryId;
                    $product->status = $item['status'];
                    $product->packaging = str_replace(",", ".", $item['packaging']);
                    $product->quantity = $item['quantity'];
                    $product->article = $item['article'];
                    $product->minimum = $item['minimum'];
                    $product->type = $request->get('type', 'Полотно');
                    $product->price = $item['price'];
                    $product->save();
                    // dd($item['filters']);
                    foreach($item['filters'] as $key=>$filter) {
                        if(strlen($filter) > 0) {
                            $value = Value::where('name', $filter)->where('filter_id', $key)->first();
                            if(isset($value)) {
                                // dd($value);
                                $value->products()->detach($product->id);
                                $value->products()->attach($product->id);
                            } else {
                                $value = new Value();
                                $value->name = $filter;
                                $value->filter_id = $key;
                                $value->save();
                                $value->products()->detach($product->id);
                                $value->products()->attach($product->id);
                            }
                        }
                    }

                }
                // Product::insert($arr);
            }
        }
        Toastr::success('', 'Успех!', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
}
