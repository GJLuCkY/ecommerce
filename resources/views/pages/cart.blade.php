@extends('layouts.master')


@section('content')
    <article class="container">
        @if(Cart::count() > 0)
            <cart-component></cart-component>
        @else
        <div class="bs-emptyBasket">
            <div class="row">
                <div class="col-sm-2 bs-links">
                    @include('partials.menu')
                </div>
                <div class="col-sm-9 bs-basket">
                    <div class="">
                        <ul class="breadcrumb">
                            <li><a href = "{{ route('homepage') }}">Главная</a></li>
                            <li>Корзина</li>
                        </ul>
                        <h5 class="bs-emptyBasket__heading">ВАША КОРЗИНА <span class="count">(0)</span></h5>
                        <p class="bs-emptyBasket__text">Чтобы заполнить корзину, выберите понравившийся Вам товар в нашем интернет-магазине и нажмите на кнопку «В корзину»</p>
                        <div class="bs-emptyBasket__shop">
                        <a href="{{ route('homepage') }}" class="bs-emptyBasket__link">Вернуться в магазин</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </article>
@endsection
