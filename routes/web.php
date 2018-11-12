<?php



Route::get('/test', function() {
    return Cart::content();

});

Route::view('excell', 'excell');
Route::post('excel', 'ExcellController@importExcell')->name('importExcel');


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
            Route::get('/', 'ProfileController@profile')->name('profile.index');
            Route::get('/wishlist', 'ProfileController@profileWishlist')->name('profile.wishlist');
            Route::get('/purchases', 'ProfileController@profilePurchases')->name('profile.purchases');
            Route::get('/purchases/{id}', 'ProfileController@getOrderInProfile')->name('profile.order');
            Route::get('/help', 'ProfileController@profileHelp')->name('profile.help');
        });
        
        // Выйти
        Route::get('/logout', 'UserController@getLogout')->name('getLogout');
    });
});

Route::auth();

// Корзина
Route::get('/cart', 'CartController@cart')->name('cart');
Route::get('/add-to-cart/{id}', 'CartController@getAddToCart')->name('addToCart');
Route::get('/remove-to-cart/{id}', 'CartController@removeToCart')->name('removeToCart');
Route::post('/cart-change-quantity', 'CartController@cartChangeQuantity')->name('cart.change.quantity');

// Избранное
Route::get('/wishlist/{id}', 'WishlistController@addWishlist')->name('wishlist');
Route::get('/wishlist/remove/{id}', 'WishlistController@removeWishlist')->name('wishlist.remove');



// Оформление заказа checkout
Route::get('/checkout', 'CheckoutController@checkout')->name('checkout');
Route::post('/checkout', 'CheckoutController@postCheckout')->name('checkout-go');

// Поиск
Route::get('/search','SearchController@search')->name('search');

// Главная страница
Route::get('/', 'PageController@index')->name('homepage');

// Новости
Route::get('/news', 'PageController@news')->name('news');
Route::get('/news/{newSlug}', 'PageController@post')->name('post');

//Бренды
Route::get('/brands', 'PageController@brands')->name('brands');
Route::get('/brands/{brandSlug}', 'PageController@brand')->name('brand');
// Route::view('/brands', 'pages.brands')->name('brands');

// Контакты
Route::view('/contacts-2', 'pages.contacts');

// Вакансии
Route::get('/vacancy/{citySlug}', 'VacancyController@vacancyCity')->name('vacancy.city');
Route::get('/vacancy/{citySlug}/{vacancyId}', 'VacancyController@vacancyId')->name('vacancy.id');

// Советы
Route::get('/advices', 'PageController@advices')->name('advices');
Route::get('/advices/{adviceSlug}', 'PageController@advice')->name('advice');

// Страницы (пр. Доставка, FAQ, О компании)
Route::get('/{pageSlug}', 'PageController@page')->name('page');

// Категории товаров
Route::get('catalog/{catSlug}', 'CategoryController@category')->name('category');
Route::get('catalog/{catSlug}/{prodSlug}', 'CategoryController@product')->name('product');
// Добавить отзыв
Route::post('/review', 'CategoryController@review')->name('review');

// Подписаться
Route::post('/subscribe', 'SubscribeController@subscribe')->name('subscribe');






Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
