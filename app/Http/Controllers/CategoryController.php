<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Filters\ProductFilter;
use App\Models\Product;
use App\Models\Filter;
use SEO;
use App\Models\Review;
use Toastr;
use Cart;


class CategoryController extends Controller
{
    public function category($catSlug, ProductFilter $filters) 
    {
        $cat = Category::where('status', 1)->where('slug', $catSlug)->firstOrFail();
        $id = $cat->id;

        $category = Category::where('status', 1)->where('slug', $catSlug)->with(['filters' => function ($query) use ($id) {
            $query->with(['values'=> function($q) use ($id) {
                $q->whereHas('products', function($qu) use ($id) {
                    $qu->where('category_id', $id);
                });
            }]);
        }])->firstOrFail();


        $ids = $category->categories->pluck('id')->toArray();
        array_push($ids, $category->id);
        $query = Product::query()->whereIn('category_id', $ids)->where('status', 1);
        $min = $query->min('price');
        $max = $query->max('price');
        $products = $query->filter($filters)->paginate(16)->appends(request()->all());
        SEO::setTitle($category->title);
        SEO::setDescription($category->meta_description);
        return view('pages.category',compact('category', 'products', 'routeParam', 'min', 'max'));
    }

    public function product($catSlug, $prodSlug) {
        
        $category = Category::where('status', 1)->where('slug', $catSlug)->firstOrFail();
        $product = Product::active()->where('slug', $prodSlug)->with(['reviews' => function($query) {
            $query->where('status', 1);
        }])->firstOrFail();
        $equipment = $product->produces->where('status', 1);
       
        $product->addView();
        SEO::setTitle($product->title);
        SEO::setDescription($product->meta_description);
        $similarProducts = Product::where('category_id', $category->id)->take(10)->get();
        return view('pages.product',compact('category', 'product', 'similarProducts', 'equipment'));
    }

    public function review(Request $request) {
        $review = new Review();
        $review->content = $request->get('content');
        $review->product_id = $request->get('product_id');
        $review->user_id = $request->get('user_id');
        $review->stars = $request->get('stars');
        $review->status = 0;
        $review->save();
        Toastr::success('Ваш отзыв отправлен на модерацию!', 'Отзыв успешно отправлен!', ["positionClass" => "toast-top-center"]);
        return redirect()->back();
    }
}
