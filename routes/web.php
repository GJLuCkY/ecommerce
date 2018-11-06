<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['prefix' => config('backpack.base.route_prefix'), 'middleware' => ['admin'], 'namespace' => 'Admin'], function()
{
    CRUD::resource('product', 'ProductCrudController');
    CRUD::resource('product-category', 'ProductCategoryCrudController');
    CRUD::resource('menu-item', 'MenuItemCrudController');

    CRUD::resource('order', 'OrderCrudController');
    CRUD::resource('filter', 'FilterCrudController');
    CRUD::resource('value', 'ValueCrudController');
    CRUD::resource('slider', 'SliderCrudController');
    CRUD::resource('review', 'ReviewCrudController');
    CRUD::resource('city', 'CityCrudController');

    CRUD::resource('vacancy', 'VacancyCrudController');
    CRUD::resource('vacancy-city', 'VacancyCityCrudController');
    CRUD::resource('advice', 'AdviceCrudController');
    CRUD::resource('address', 'AddressCrudController');
});

Route::get('/test', function() {
    $api_token = str_random(60);
    return $api_token;

    $data = array_merge($firstArray, $secondArray);

    dd($data);
});
Route::group(['prefix' => 'user'], function () {
    Route::group(['middleware' => 'guest'], function () {
        // Регистрация
        Route::post('/signup', 'UserController@signup')->name('signup');
        // Войти
        Route::post('/signin', 'UserController@signin')->name('signin');
        // Войти (View)
        Route::get('/signin', 'UserController@getSignin')->name('getSignin');
    });
    Route::group(['middleware' => 'auth'], function () {
        // Личный кабинет
        Route::group(['prefix' => 'profile'], function () {
            Route::get('/', 'IndexController@profile')->name('profile.index');
            Route::get('/wishlist', 'IndexController@profileWishlist')->name('profile.wishlist');
            Route::get('/purchases', 'IndexController@profilePurchases')->name('profile.purchases');
            Route::get('/purchases/{id}', 'IndexController@getOrderInProfile')->name('profile.order');
            Route::get('/help', 'IndexController@profileHelp')->name('profile.help');
        });
        
        // Выйти
        Route::get('/logout', 'UserController@getLogout')->name('getLogout');
    });
});

Route::auth();

Route::get('/brands', 'IndexController@brands')->name('brands');
Route::get('/brands/{brandSlug}', 'IndexController@brand')->name('brand');


Route::get('/vacancy/{citySlug}', 'IndexController@vacancyCity')->name('vacancy.city');
Route::get('/vacancy/{citySlug}/{vacancyId}', 'IndexController@vacancyId')->name('vacancy.id');

Route::get('/advices', 'IndexController@advices')->name('advices');

Route::get('/advices/{adviceSlug}', 'IndexController@advice')->name('advice');

Route::view('/brands', 'pages.brands')->name('brands');

Route::get('/search','SearchController@search')->name('search');

Route::get('/add-to-cart/{id}', 'IndexController@getAddToCart')->name('addToCart');
Route::get('/remove-to-cart/{id}', 'IndexController@removeToCart')->name('removeToCart');
Route::get('/wishlist/{id}', 'IndexController@addWishlist')->name('wishlist');
Route::get('/wishlist/remove/{id}', 'IndexController@removeWishlist')->name('wishlist.remove');
// Корзина
Route::get('/cart', 'IndexController@cart')->name('cart');

// Оформление заказа checkout
Route::get('/checkout', 'IndexController@checkout')->name('checkout');
Route::post('/checkout', 'IndexController@postCheckout')->name('checkout-go');

// Главная страница
Route::get('/', 'IndexController@index')->name('homepage');

// Новости
Route::get('/news', 'IndexController@news')->name('news');

// Новость
Route::get('/news/{newSlug}', 'IndexController@post')->name('post');

// Страницы (пр. Доставка, FAQ, О компании)
Route::get('/{pageSlug}', 'IndexController@page')->name('page');

// Категории товаров
Route::get('catalog/{catSlug}', 'IndexController@category')->name('category');

// Продукты
Route::get('/{catSlug}/{prodSlug}', 'IndexController@product')->name('product');
Route::post('/review', 'IndexController@review')->name('review');
Route::post('/subscribe', 'IndexController@subscribe')->name('subscribe');

Route::post('/cart-change-quantity', 'IndexController@cartChangeQuantity')->name('cart.change.quantity');



