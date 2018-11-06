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
        View::composer(['pages.contacts', 'pages.brand', 'pages.brands', 'pages.advices', 'pages.advice', 'pages.vacancy-city', 'pages.vacancy', 'pages.homepage', 'pages.category', 'pages.inner-news', 'pages.news', 'pages.page', 'pages.product', 'pages.cart', 'pages.checkout', 'pages.search', 'pages.profile.index', 'pages.profile.wishlist', 'pages.profile.purchases', 'pages.profile.order', 'pages.profile.help', 'auth.login'] , 'App\Http\ViewComposers\MenuComposer');

        View::composer(['pages.contacts', 'pages.brand', 'pages.brands', 'pages.advices', 'pages.advice', 'pages.vacancy-city', 'pages.vacancy', 'pages.homepage', 'pages.category', 'pages.inner-news', 'pages.news', 'pages.page', 'pages.product', 'pages.cart', 'pages.checkout', 'pages.profile.index', 'pages.profile.wishlist', 'pages.profile.purchases', 'pages.profile.order', 'pages.profile.help', 'pages.search', 'auth.login'] , 'App\Http\ViewComposers\CityComposer');

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
