<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Models\Review;
use App\Models\Slider;
use App\Filters\ProductFilter;
use App\Models\Order;
use App\Models\Product;
use App\Models\Value;
use App\Models\Filter;
use App\Models\VacancyCity;
use App\Models\Advice;
use App\Models\Vacancy;
use Wishlist;
use SEO;
use Backpack\NewsCRUD\app\Models\Article;
use Backpack\PageManager\app\Models\Page;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;
use Newsletter;
use Toastr;


class IndexController extends Controller
{
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
        $post = Article::where('slug', $postSlug)->firstOrFail();
        SEO::setTitle($post->title);
        SEO::setDescription('Описание');
        return view('pages.inner-news',compact('post'));
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
    public function category($catSlug, ProductFilter $filters) 
    {
        $category = ProductCategory::where('status', 1)->where('slug', $catSlug)->with(['filters' => function ($query) {
            $query->with('values');
        }])->firstOrFail();
        $query = Product::query()->where('category_id', $category->id)->where('status', 1);
        $min = $query->min('price');
        $max = $query->max('price');
        $products = $query->filter($filters)->paginate(16)->appends(request()->all());
        SEO::setTitle($category->title);
        SEO::setDescription($category->meta_description);
        return view('pages.category',compact('category', 'products', 'routeParam', 'min', 'max'));
    }
    public function product($catSlug, $prodSlug) {
        $category = ProductCategory::where('status', 1)->where('slug', $catSlug)->firstOrFail();
        $product = Product::where('status', 1)->where('slug', $prodSlug)->with(['reviews' => function($query) {
            $query->where('status', 1);
        }])->firstOrFail();

        $product->addView();
        SEO::setTitle($product->title);
        SEO::setDescription($product->meta_description);
        $similarProducts = Product::where('category_id', $category->id)->take(10)->get();
        return view('pages.product',compact('category', 'product', 'similarProducts'));
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

    public function cart() {
        SEO::setTitle('Корзина');
        SEO::setDescription('Корзина Etalon Holding');
        if(!Session::has('cart')){
            return view('pages.cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('pages.cart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }
    public function profile() {
        SEO::setTitle('Личный кабинет');
        SEO::setDescription('Личный кабинет Etalon Holding');
        return view('pages.profile.index');
    }

    public function profileWishlist() {

        $wishlist = Wishlist::getUserWishlist(1)->load('product');
        SEO::setTitle('Личный кабинет');
        SEO::setDescription('Личный кабинет Etalon Holding');
        return view('pages.profile.wishlist', compact(['wishlist']));
    }

    public function profilePurchases() {
        $orders = Order::where('user_id', Auth::user()->id)->get();
        SEO::setTitle('Личный кабинет');
        SEO::setDescription('Личный кабинет Etalon Holding');
        return view('pages.profile.purchases', compact(['orders']));
    }

    public function getOrderInProfile($id) {
        $order = Order::where('id', $id)->first();
        SEO::setTitle('Личный кабинет');
        SEO::setDescription('Личный кабинет Etalon Holding');
        return view('pages.profile.order', compact('order'));
    }

    public function profileHelp() {
        SEO::setTitle('Личный кабинет');
        SEO::setDescription('Личный кабинет Etalon Holding');
        return view('pages.profile.help');
    }

    public function getAddToCart(Request $request, $id) {
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);
        $request->session()->put('cart', $cart);
        Toastr::success('', 'Товар добавлен в корзину!', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    public function removeToCart(Request $request, $id) {
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->remove($product, $product->id);
        $request->session()->put('cart', $cart);
        Toastr::success('', 'Товар добавлен в корзину!', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    public function checkout() {
        SEO::setTitle('Оформление заказа');
        SEO::setDescription('Оформление заказа Etalon Holding');
        if(!Session::has('cart')){
            return redirect()->route('cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('pages.checkout', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }
    
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

    public function subscribe(Request $request) {
        Newsletter::subscribe($request->get('email'));
        Toastr::success('', 'Вы успешно подписались на рассылку!', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    public function vacancyCity($citySlug) {
        $city = VacancyCity::where('status', 1)->whereSlug($citySlug)->firstOrFail();
        if(count($city->vacancies) > 0) {
            $last = $city->vacancies->first();
            return redirect()->route('vacancy.id', ['citySlug' => $city->slug,'vacancyId' => $last->id]);
        }
        $vacancyCities = VacancyCity::orderBy('lft')->where('status', 1)->get();
        return view('pages.vacancy-city', compact('city', 'vacancyCities'));
    }

    public function vacancyId($citySlug, $vacancyId) {
        $vacancyWithoutFakes = Vacancy::where('id', $vacancyId)->firstOrFail();
        $vacancy = $vacancyWithoutFakes->withFakes();
        $city = VacancyCity::whereSlug($citySlug)->where('status', 1)->firstOrFail();
        $vacancyCities = VacancyCity::orderBy('lft')->where('status', 1)->get();
        return view('pages.vacancy', compact('vacancy', 'city', 'vacancyCities'));
    }

    public function advices() {
        $advices = Advice::latest()->where('status', 1)->get();
        return view('pages.advices', compact('advices'));
    }

    public function advice($adviceSlug) {
        $advice = Advice::where('status', 1)->whereSlug($adviceSlug)->firstOrFail();
        return view('pages.advice', compact('advice'));
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

    public function postCheckout(Request $request) {
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $totalPrice = $cart->totalPrice;
        $object = $cart->items;
        $productsId = (array)$object;
        $order = new Order;
        $order->phone = $request->get('phone');
        $order->city = 'todo';
        $order->address = $request->get('address');
        $order->email = $request->get('email');
        $order->name = $request->get('name');
        $order->comment = $request->get('comment');
        $order->method = 'TODO';
        $order->status = 'create';
        $order->products = $request->get('products');
        $order->user_id = $request->get('user_id');
        $order->save();
        $order->products()->attach(array_keys($productsId));
        Session::forget('cart');
        Toastr::success('', 'Вы успешно оформили заказ', ["positionClass" => "toast-top-right"]);
        return redirect()->route('homepage');
    }
}
