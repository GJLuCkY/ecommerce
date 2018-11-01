<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
<<<<<<< HEAD
        View::composer(['pages.brands', 'pages.advices', 'pages.advice', 'pages.vacancy-city', 'pages.vacancy', 'pages.homepage', 'pages.category', 'pages.inner-news', 'pages.news', 'pages.page', 'pages.product', 'pages.cart', 'pages.checkout', 'pages.search', 'pages.profile.index', 'pages.profile.wishlist', 'pages.profile.purchases', 'pages.profile.order', 'pages.profile.help', 'auth.login'] , 'App\Http\ViewComposers\MenuComposer');

        View::composer(['pages.brands', 'pages.advices', 'pages.advice', 'pages.vacancy-city', 'pages.vacancy', 'pages.homepage', 'pages.category', 'pages.inner-news', 'pages.news', 'pages.page', 'pages.product', 'pages.cart', 'pages.checkout', 'pages.profile.index', 'pages.profile.wishlist', 'pages.profile.purchases', 'pages.profile.order', 'pages.profile.help', 'pages.search', 'auth.login'] , 'App\Http\ViewComposers\CityComposer');
=======
        View::composer(['pages.brand', 'pages.brands', 'pages.advices', 'pages.advice', 'pages.vacancy-city', 'pages.vacancy', 'pages.homepage', 'pages.category', 'pages.inner-news', 'pages.news', 'pages.page', 'pages.product', 'pages.cart', 'pages.checkout', 'pages.search', 'pages.profile.index', 'pages.profile.wishlist', 'pages.profile.purchases', 'pages.profile.order', 'pages.profile.help', 'auth.login'] , 'App\Http\ViewComposers\MenuComposer');

        View::composer(['pages.brand', 'pages.brands', 'pages.advices', 'pages.advice', 'pages.vacancy-city', 'pages.vacancy', 'pages.homepage', 'pages.category', 'pages.inner-news', 'pages.news', 'pages.page', 'pages.product', 'pages.cart', 'pages.checkout', 'pages.profile.index', 'pages.profile.wishlist', 'pages.profile.purchases', 'pages.profile.order', 'pages.profile.help', 'pages.search', 'auth.login'] , 'App\Http\ViewComposers\CityComposer');
>>>>>>> 9f666855faa7ff19a88f9a823518ac5fa78758b1

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
