@extends('layouts.master')

@section('home-menu-and-slider')
    <article class="container">
        <div class="bs-top">
            <div class="row">
                <div class="col-sm-2 bs-links">
                    @include('partials.menu')
                </div>
                <div class="col-sm-10 bs-top__main">
                    <div class="one-time">
                        @foreach($sliders as $slider)
                        <a href="{{ $slider->url }}" class="bs-top__item">
                            <img src="{{ asset('uploads/' . $slider->image) }}" alt="newPic">
                            <div class="bs-top__item-text">
                                <h5>{{ $slider->title }}</h5>
                                {!! $slider->content !!}
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('content')
    <div class="bs-catalog">
        <h5 class="bs-catalog__brandText">Бренды</h5>
        <div class="brands">
            @foreach($brand->values as $item)
            <div class="bs-catalog__brand">
                <img src="{{ asset('uploads/' . $item->image) }}" alt="{{$item->name}}">
            <p>{{ $item->name }}</p>
            </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-10">
                <div class="row bs-catalog__hits">
                    <h5 class="bs-catalog__head">Хиты продаж</h5>
                    <div class="hits">
                        @foreach($bestsellers as $product)
                      
                        <div class="bs-catalog__hit">
                            <div class="bs-catalog__hitImg">
                                <a href="{{ route('product', ['catSlug' => $product->category->slug, 'prodSlug' => $product->slug]) }}">
                                    <img src="{{ asset('uploads/' . $product->image) }}" alt="{{ $product->title }}">
                                </a>
                                <a href="{{ route('wishlist', ['id' => $product->id]) }}" class="back-wishlist">
                                    <img src="/images/fav.svg" alt="favorite">
                                    <div class="bs-catalog__fav">
                                        Добавить в избранное
                                    </div>
                                </a>
                
                                <div class="bs-catalog__hitText">
                                    <p>3-х слойная паркетная доска
                                    <br> <a href="{{ route('product', ['catSlug' => $product->category->slug, 'prodSlug' => $product->slug]) }}">{{ $product->title }}</a>
                                    @if(isset($product->brand))
                                    <br> {{ $product->brand->name }} </p>
                                    @endif
                                </div>
                            </div>
                            @php
                            $cartItems = session()->has('cart') ? session('cart')->items : [];
                            $inCart = array_key_exists($product->id, $cartItems);
                            @endphp
                            <p class="bs-catalog__size">10 000 кв.м</p>
                            <a href="{{ $inCart ? route('cart') : route('addToCart', ['id' => $product->id]) }}" class="bs-catalog__add">
                                <img src="/images/basket.svg" alt="basket" class="bs-catalog__basket">
                                @if($inCart)
                                В корзине
                                @else
                                Добавить в корзину
                                @endif</a>
                                
                            <div class="bs-catalog__compare">
                                <ul>
                                    
                                        <star-rating :rating={{ $product->getCountActiveReviews() }} :read-only="true" :show-rating="false" :star-size="16" :round-start-rating="false"></star-rating>
                                    
                                    <li class="bs-catalog__cm">
                                        <a href="">Сравнить товар</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="row bs-catalog__news">
                    <h5 class="bs-catalog__head">Новинки</h5>
                    <div class="hits">
                        @foreach($latests as $product)
                        <div class="bs-catalog__hit">
                            <div class="bs-catalog__hitImg">
                                <a href="{{ route('product', ['catSlug' => $product->category->slug, 'prodSlug' => $product->slug]) }}">
                                    <img src="{{ asset('uploads/' . $product->image) }}" alt="{{ $product->title }}">
                                </a>
                                <a href="{{ route('wishlist', ['id' => $product->id]) }}" class="back-wishlist">
                                    <img src="/images/fav.svg" alt="favorite">
                                </a>
                                <div class="bs-catalog__hitText">
                                        <p>3-х слойная паркетная доска
                                        <br> <a href="{{ route('product', ['catSlug' => $product->category->slug, 'prodSlug' => $product->slug]) }}">{{ $product->title }}</a>
                                        @if(isset($product->brand))
                                        <br> {{ $product->brand->name }} </p>
                                        @endif
                                </div>
                            </div>
                            @php
                            $cartItems = session()->has('cart') ? session('cart')->items : [];
                            $inCart = array_key_exists($product->id, $cartItems);
                            @endphp
                            <p class="bs-catalog__size">10 000 кв.м</p>
                            <a href="{{ $inCart ? route('cart') : route('addToCart', ['id' => $product->id]) }}" class="bs-catalog__add">
                                <img src="/images/basket.svg" alt="basket" class="bs-catalog__basket">
                                @if($inCart)
                                В корзине
                                @else
                                Добавить в корзину
                                @endif
                            </a>
                            <div class="bs-catalog__compare">
                                <ul>
                                <star-rating :rating={{ $product->getCountActiveReviews() }} :read-only="true" :show-rating="false" :star-size="16" :round-start-rating="false"></star-rating>
                                    <li class="bs-catalog__cm"><a href="">Сравнить товар</a></li>
                                </ul>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('home-footer')
        <hr class="bs-line">
        <div class="container">
            <div class="bs-flat">
                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-10">
                        <h5 class="bs-catalog__head">Собери свою квартиру</h5>
                        <ul class="bs-flat__list">
                            <li class="bs-flat__item active"><a href="" class="bs-flat__link">Kronotex</a></li>
                            <li class="bs-flat__item"><a href="" class="bs-flat__link">Kronostar</a></li>
                            <li class="bs-flat__item"><a href="" class="bs-flat__link">Falquon</a></li>
                            <li class="bs-flat__item"><a href="" class="bs-flat__link">Villeroy & Boch</a></li>
                            <li class="bs-flat__item"><a href="" class="bs-flat__link">Art Deko</a></li>
                            <li class="bs-flat__item"><a href="" class="bs-flat__link">Zadoor</a></li>
                        </ul>
                        <img src="/images/flat.png" alt="flat">
                    </div>
                </div>
            </div>
        </div>
    </article>
@endsection