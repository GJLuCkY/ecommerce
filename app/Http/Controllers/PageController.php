<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SEO;

use App\Models\Slider;
use Backpack\NewsCRUD\app\Models\Article;
use Backpack\PageManager\app\Models\Page;
use App\Models\Advice;
use App\Models\Order;
use App\Models\Product;
use App\Models\Value;
use App\Models\Filter;
use App\Models\VacancyCity;


class PageController extends Controller
{

    public function advices() {
        $advices = Advice::latest()->where('status', 1)->get();
        return view('pages.advices', compact('advices'));
    }

    public function advice($adviceSlug) {
        $advice = Advice::where('status', 1)->whereSlug($adviceSlug)->firstOrFail();
        return view('pages.advice', compact('advice'));
    }

    public function index() {
        SEO::setTitle('Главная страница');
        SEO::setDescription('Описание главной страницы');
        $sliders = Slider::where('status', 1)->orderBy('lft')->get();
        $brand = Filter::where('id', 1)->first();
        $latests = Product::latest()->where('status', 1)->take(10)->get();
        $bestsellers = Product::withCount('orders')->where('status', 1)->orderBy('orders_count', 'desc')->take(10)->get();
        return view('pages.homepage', compact('sliders', 'brand', 'bestsellers', 'latests'));
    }
    public function news() {
        SEO::setTitle('Новости');
        SEO::setDescription('Описание новости');
        $news = Article::latest()->where('status', 'PUBLISHED')->paginate(12);
        return view('pages.news',compact('news'));
    }
    public function post($postSlug) {
        $post = Article::where('slug', $postSlug)->where('status', 'PUBLISHED')->firstOrFail();
        SEO::setTitle($post->title);
        SEO::setDescription('Описание');
        $news = Article::where('id', '!=', $post->id)->where('status', 'PUBLISHED')->inRandomOrder()->take(3)->get();

        return view('pages.inner-news',compact('post', 'news'));
    }
    public function page($pageSlug) {
        $page = Page::where('slug', $pageSlug)->firstOrFail();
        SEO::setTitle(json_decode($page->extras)->meta_title);
        SEO::setDescription(json_decode($page->extras)->meta_description);
        if($page->template == 'vacancy') {
            $vacancyCities = VacancyCity::orderBy('lft')->where('status', 1)->get();
        } else {
            $vacancyCities = [];
        }
        return view('pages.page',compact('page', 'vacancyCities'));
    }
    

    
    

    

    

    

    public function brands() {
        $values = Value::where('filter_id', 1)->get();
      
        return view('pages.brands', compact('values'));
    }

    public function brand($brandSlug) {
        $brand = Value::whereSlug($brandSlug)->firstOrFail();
        $products = $brand->products->where('status', 1);
        $values = Value::where('filter_id', 1)->get();
        return view('pages.brand', compact('brand', 'products', 'values'));
    }
}
