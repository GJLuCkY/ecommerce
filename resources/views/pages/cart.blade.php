@extends('layouts.master')


@section('content')
    <article class="container">
        @if(Session::has('cart'))
        <div class="bs-basket">
            <ul class="breadcrumb">
                <li><a href="{{ route('homepage') }}">Главная</a></li>
                <li>Корзина</li>
            </ul>
            <div class="row"  style="margin-bottom: 60px">
                <div class="col-sm-9">
                    <h5 class="bs-basket__heading">ВАША КОРЗИНА <span class="count">({{count($products)}})</span></h5>
                    @foreach($products as $product)

                    <div class="row bs-basket__row">
                        <div class="col-sm-1 bs-basket__img">
                            <img src="{{ asset('uploads/' . $product['item']->image ) }}" class="">
                        </div>
                        <div class="col-sm-4 bs-basket__bigCol">
                            <p class="bs-basket__about">{{ $product['item']->title }}
                                <br>3-х слойная паркетная доска
                                <br>{{ $product['item']->title }}
                            </p>
                        </div>
                        <div class="col-sm-3 bs-basket__qual">
                            {{-- <h6 class="bs-basket__title">Количество</h6> --}}
                            <div class="bs-basket__counter">
                                <button type="button">+</button>
                                <p>{{ $product['qty'] }}</p>
                                <button type="button">-</button>
                            </div>
                        </div>
                        <div class="col-sm-3 bs-basket__cost">
                            <p class="bs-basket__cost">{{ number_format($product['price'] /  $product['qty'], null, ' ', ' ') }}  тг / 1 шт.</p>
                            <h4 class="bs-basket__costTotal">{{ number_format($product['price'], null, ' ', ' ') }} тг / {{ $product['qty'] }} шт.</h4>
                        </div>
                        <div class="col-sm-1 bs-basket__delete">
                            <a href="{{ route('removeToCart', ['id' => $product['item']->id]) }}"><img src="/images/delete.svg" alt="X" class=""></a>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="col-sm-3">
                    <h6 class="bs-basket__costHead">Способ получения заказа</h6>
                    <div>
                        <form class="bs-basket__check">
                            <label>
                                <input type="radio" name="radio" checked="checked"> Самовывоз
                                <span class="checkmark"></span>
                            </label>
                            <label>
                                <input type="radio" name="radio"> Доставка
                                <span class="checkmark"></span>
                            </label>
                        </form>
                        <p class="bs-basket__text">Для уточнения цены доставки с Вами сяжется наш прекрасный менеджер.</p>
                        <hr class="bs-basket__line">
                        <p class="bs-basket__text bs-basket__text--total">ИТОГОВАЯ СТОИМОСТЬ</p>
                        <p class="bs-basket__costText"> {{ number_format($totalPrice, null, ' ', ' ') }} тг
                        </p>
                        <button class="bs-basket__order">
                            <a href="{{ route('checkout') }}"> Оформить заказ</a>
                        </button>
                        <form>
                            <input class="bs-basket__promo" type="text" name="promo" placeholder="ПРОМОКОД">
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
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
